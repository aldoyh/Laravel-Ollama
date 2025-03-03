<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromptRequest;
use App\Http\Requests\UpdatePromptRequest;
use App\Models\Prompt;
use App\Services\GroqService;
use Cloudstudio\Ollama\Facades\Ollama;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PromptController extends Controller
{
    public function __construct(
        protected GroqService $groqService
    ) {}

    /**
     * Handle the incoming request for AI response generation.
     */
    public function __invoke(Request $request): View
    {
        $promptText = $request->input('prompt');
        $response = null;
        $error = null;

        try {
            $response = Ollama::ask($promptText);

            // Store the successful interaction
            $this->storePrompt($promptText, $response);
        } catch (\Exception $e) {
            Log::error('Ollama service failed', [
                'error' => $e->getMessage(),
                'prompt' => $promptText
            ]);

            try {
                $response = $this->groqService->generateResponse($promptText);
                $this->storePrompt($promptText, $response, 'groq');
            } catch (\Exception $fallbackError) {
                Log::error('Groq service failed', [
                    'error' => $fallbackError->getMessage(),
                    'prompt' => $promptText
                ]);
                $error = 'Both primary and backup AI services failed.';
            }
        }

        return view('prompt', compact('promptText', 'response', 'error'));
    }

    /**
     * Display a listing of the prompts.
     */
    public function index(): View
    {
        $prompts = Prompt::with('user')
            ->latest()
            ->paginate(20);

        return view('prompts.index', compact('prompts'));
    }

    /**
     * Show the form for creating a new prompt.
     */
    public function create(): View
    {
        return view('prompts.create');
    }

    /**
     * Store a newly created prompt in storage.
     */
    public function store(StorePromptRequest $request): JsonResponse
    {
        $prompt = new Prompt($request->validated());
        $prompt->user_id = $request->user()->id;
        $prompt->save();

        return response()->json($prompt, 201);
    }

    /**
     * Display the specified prompt.
     */
    public function show(Prompt $prompt): View
    {
        $this->authorize('view', $prompt);
        return view('prompts.show', compact('prompt'));
    }

    /**
     * Show the form for editing the specified prompt.
     */
    public function edit(Prompt $prompt): View
    {
        $this->authorize('update', $prompt);
        return view('prompts.edit', compact('prompt'));
    }

    /**
     * Update the specified prompt in storage.
     */
    public function update(UpdatePromptRequest $request, Prompt $prompt): JsonResponse
    {
        $this->authorize('update', $prompt);
        $prompt->update($request->validated());

        return response()->json($prompt);
    }

    /**
     * Remove the specified prompt from storage.
     */
    public function destroy(Prompt $prompt): JsonResponse
    {
        $this->authorize('delete', $prompt);
        $prompt->delete();

        return response()->json(['message' => 'Prompt deleted successfully']);
    }

    /**
     * Store a prompt and its response.
     */
    protected function storePrompt(string $promptText, ?string $response, string $model = 'llama3'): void
    {
        if (Auth::check()) {
            Prompt::create([
                'user_id' => Auth::id(),
                'prompt' => $promptText,
                'response' => $response,
                'model' => $model
            ]);
        }
    }
}

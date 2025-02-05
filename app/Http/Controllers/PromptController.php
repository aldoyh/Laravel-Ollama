<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromptRequest;
use App\Http\Requests\UpdatePromptRequest;
use App\Models\Prompt;
use Laravel\Prompts\Prompts;
use App\Services\GroqService;
use Cloudstudio\Ollama\Facades\Ollama as FacadesOllama;
use CloudStudio\OllamaLaravel\Facades\Ollama;
use Illuminate\Http\Request;

class PromptController extends Controller
{
    protected $groqService;

    public function __construct(GroqService $groqService)
    {
        $this->groqService = $groqService;
    }

    public function __invoke(Request $request)
    {
        try {
            $promptText = $request->input('prompt');
            $response = FacadesOllama::ask($promptText);

            return view('prompt', [
                'promptText' => $promptText,
                'response' => $response
            ]);
        } catch (\Exception $e) {
            // Fallback to Groq if Ollama fails
            try {
                $response = $this->groqService->generateResponse($promptText);

                return view('prompt', [
                    'promptText' => $promptText,
                    'response' => $response
                ]);
            } catch (\Exception $fallbackError) {
                return view('prompt', [
                    'promptText' => $promptText,
                    'errorMessage' => 'Both primary and backup AI services failed.'
                ]);
            }
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all prompts from the database
        $prompts = Prompt::all();

        // Return the prompts as a response
        return response()->json($prompts);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new prompt
        return view('prompts.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePromptRequest $request)
    {
        // Create a new prompt with the validated data
        $prompt = Prompt::create($request->validated());

        // Return the created prompt as a response
        return response()->json($prompt, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Prompt $prompt)
    {
        // Return the specified prompt as a response
        return response()->json($prompt);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prompt $prompt)
    {
        // Return the view for editing the specified prompt
        return view('prompts.edit', compact('prompt'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePromptRequest $request, Prompt $prompt)
    {
        // Update the prompt with the validated data
        $prompt->update($request->validated());

        // Return the updated prompt as a response
        return response()->json($prompt);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prompt $prompt)
    {
        // Delete the specified prompt from the database
        $prompt->delete();

        // Return a success message as a response
        return response()->json(['message' => 'Prompt deleted successfully']);
    }
}

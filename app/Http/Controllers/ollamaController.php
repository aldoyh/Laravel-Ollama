<?php

namespace App\Http\Controllers;

use App\Models\Prompt;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Cloudstudio\Ollama\Facades\Ollama;

class OllamaController extends Controller
{

    public function prompt(Request $request): View
    {
        $promptText = $request->input('promptText') ?? 'What is the meaning of life?';

        Prompt::create([
            'prompt' => $promptText
        ]);
        return view('prompt');
    }

    public function answer(Request $request): View
    {

        $promptText = $request->input('promptText');

        try {
            $response = Ollama::prompt($promptText)
                // ->model('llama2')\
                ->model('mistral')
                ->options(['temperature' => 0.8])
                ->stream(false)
                ->ask();

            return view('prompt')
                ->with('promptText', $promptText)
                ->with('response', $response);

        }catch (\Illuminate\Http\Client\ConnectionException $e) {
            return view('prompt')
                ->with('errorMessage', $e->getMessage()
                );
        }

    }

}

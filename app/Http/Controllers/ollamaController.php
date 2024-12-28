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
        $promptText = $request->input('promptText');

        if (empty($promptText)) {
            return view('prompt')
            ->with('errorMessage', 'Please enter a prompt');
        }

        // take the first line, shouldn't exceed 200 characters
        $promptTitle = explode("\n", $promptText)[0];
        $promptTitle = substr($promptTitle, 0, 200);

        if (!Prompt::where('name', $promptTitle)->exists()) {

            Prompt::create([
                'name' => $promptTitle,
                'prompt' => $promptText
            ]);
        }

        return view('prompt')
            ->with('promptText', $promptText);
    }

    public function answer(Request $request): View
    {

        $promptText = $request->input('promptText');

        if (empty($promptText)) {
            return view('prompt')
                ->with('errorMessage', 'Please enter a prompt');
        }

        try {
            
            $response = Ollama::prompt($promptText)
                ->model('llama2')
                // ->model('mistral')
                ->options(['temperature' => 0.8])
                ->stream(false)
                ->ask();

            return view('prompt')
                ->with('promptText', $promptText)
                ->with('response', $response);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            return view('prompt')
                ->with(
                    'errorMessage',
                    $e->getMessage()
                );
        }
    }
}

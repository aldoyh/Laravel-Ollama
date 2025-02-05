<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GroqService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.groq.com/v1';

    public function __construct()
    {
        $this->apiKey = config('services.groq.key');
    }

    public function generateResponse($prompt)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json'
        ])->post($this->baseUrl . '/chat/completions', [
            'model' => 'mixtral-8x7b-32768',
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0.7,
            'max_tokens' => 2048
        ]);

        return $response->json()['choices'][0]['message']['content'] ?? null;
    }
}

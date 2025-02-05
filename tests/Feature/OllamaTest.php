<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Cloudstudio\Ollama\Facades\Ollama;

class OllamaTest extends TestCase
{
    use RefreshDatabase;

    public function test_prompt_page_loads(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_empty_prompt_returns_error(): void
    {
        $response = $this->post('/prompt', [
            'promptText' => ''
        ]);

        $response->assertViewHas('errorMessage', 'Please enter a prompt');
    }

    public function test_ollama_successful_response(): void
    {
        Ollama::fake([
            '*' => 'This is a successful response from Ollama'
        ]);

        $response = $this->post('/prompt', [
            'promptText' => 'Hello'
        ]);

        $response->assertViewHas('responseText', 'This is a successful response from Ollama');
    }

    public function test_ollama_failed_response(): void
    {
        Ollama::fake([
            '*' => 'Error: Something went wrong'
        ]);

        $response = $this->post('/prompt', [
            'promptText' => 'Hello'
        ]);

        $response->assertViewHas('errorMessage', 'Error: Something went wrong');
    }
}

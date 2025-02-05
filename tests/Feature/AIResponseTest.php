<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AIResponseTest extends TestCase
{
    public function test_ollama_responds()
    {
        $response = $this->postJson('/api/ollama/chat', [
            'message' => 'Hello, are you working?'
        ]);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'response',
                    'status'
                ]);
    }

    public function test_xai_responds()
    {
        $response = $this->postJson('/api/xai/chat', [
            'message' => 'Hello, are you working?'
        ]);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'response',
                    'status'
                ]);
    }
}

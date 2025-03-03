<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prompt extends Model
{
    use HasFactory;

    protected $fillable = [
        'prompt',
        'response',
        'model'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the prompt.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Validate and set the prompt text.
     *
     * @param string $prompt
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setPrompt(string $prompt): void
    {
        if (empty(trim($prompt))) {
            throw new \InvalidArgumentException('Prompt cannot be empty');
        }
        $this->prompt = trim($prompt);
    }

    /**
     * Set the response for this prompt.
     *
     * @param string|null $response
     * @return void
     */
    public function setResponse(?string $response): void
    {
        $this->response = $response;
    }
}

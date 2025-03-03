<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prompts', function (Blueprint $table) {
            $table->id();

            // User relationship
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Prompt text - using text instead of string for longer content
            $table->text('prompt');

            // Response - using text instead of string for longer content
            $table->text('response')->nullable();

            // Model selection
            $table->string('model')
                  ->default('llama3')
                  ->comment('The AI model used for this prompt');

            // Timestamps
            $table->timestamps();

            // Add indexes
            $table->index('user_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prompts');
    }
};

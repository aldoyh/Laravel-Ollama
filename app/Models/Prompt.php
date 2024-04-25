<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prompt extends Model
{
    use HasFactory;

    protected $fillable = [
        'prompt',
        'response',
        'model'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function model()
    {
        return $this->belongsTo(Model::class);
    }

    public function getPromptText()
    {
        return $this->prompt_text;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getModel()
    {
        return $this->model;
    }


    public function setPromptText($prompt_text)
    {
        $this->prompt_text = $prompt_text;
    }

    public function setResponse($response)
    {
        $this->response = $response;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePromptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'prompt' => ['required', 'string', 'min:1', 'max:2000'],
            'model' => ['sometimes', 'string', 'in:llama3,groq'],
            'response' => ['sometimes', 'nullable', 'string']
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'prompt.required' => 'A prompt is required.',
            'prompt.min' => 'The prompt must not be empty.',
            'prompt.max' => 'The prompt cannot exceed 2000 characters.',
            'model.in' => 'The selected AI model is not valid.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'prompt' => trim($this->prompt),
        ]);
    }
}

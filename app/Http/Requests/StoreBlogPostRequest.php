<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'movie_id' => 'required|exists:movies,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'A blog post title is required.',
            'title.string' => 'The title must be a valid string.',
            'title.max' => 'The title cannot be longer than 255 characters.',
            'content.required' => 'Blog content is required.',
            'content.string' => 'The content must be a valid string.',
            'content.min' => 'The content must be at least 10 characters long.',
            'movie_id.required' => 'A valid movie ID is required.',
            'movie_id.exists' => 'The selected movie does not exist.',
        ];
    }
}

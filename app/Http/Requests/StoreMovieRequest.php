<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_date' => 'required|date_format:Y-m-d',
            'genres' => 'nullable|array', // ✅ Genres can be omitted
            'genres.*' => 'exists:genres,id', // ✅ Each genre must exist in the genres table
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'A movie title is required.',
            'description.required' => 'A movie description is required.',
            'release_date.required' => 'The release date is required.',
            'release_date.date' => 'The release date must be a valid date.',
            'genres.array' => 'Genres must be an array.',
            'genres.*.exists' => 'One or more selected genres do not exist.',
        ];
    }
}

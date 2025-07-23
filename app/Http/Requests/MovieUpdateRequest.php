<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:200',
            'duration' => 'required|integer|between:80,180',
            'rating' => 'numeric|between:1,5',
            'release_date' => 'required|date',
            'director' => 'required|string|max:50',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
            'actors' => 'required|array',
            'actors.*' =>'exists:actors,id',
            'image' => 'file|mimes:png,jpg,jpeg|max:5120'
        ];
    }
}

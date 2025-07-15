<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActorUpdateRequest extends FormRequest
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
            'full_name' => 'required|string|max:50',
            'birth_date' => 'required|date',
            'nationality' => 'required|string|max:50',
            'height' => 'required|numeric|between:150,200',
            'image' => 'nullable|file|mimes:png,jpg,jpeg|max:5120'
        ];
    }
}

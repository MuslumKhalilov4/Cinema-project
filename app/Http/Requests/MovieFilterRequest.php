<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieFilterRequest extends FormRequest
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
            'search' => 'nullable|string',
            'order_by' => 'nullable|string|in:duration,rating,release_date,created_at',
            'order' => 'nullable|in:asc,desc',
            'includes' => 'nullable|array',
            'includes.*' => 'in:genres,actors'
        ];
    }
}

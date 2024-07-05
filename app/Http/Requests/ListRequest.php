<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => 'nullable|array',
            'search.status' => 'nullable|boolean',
            'search.complete_till' => 'nullable|integer',
        ];
    }
}

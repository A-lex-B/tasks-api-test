<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'complete_till' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ];
    }
}

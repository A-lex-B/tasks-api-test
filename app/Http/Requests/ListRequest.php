<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Query parameters
 */
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

    protected function prepareForValidation(): void
    {
        if ($this->input('search.status') === 'true') {
            $this->merge([
                'search' => [
                    'status' => true,
                    'complete_till' => $this->input('search.complete_till')
                ]
            ]);
        }

        if ($this->input('search.status') === 'false') {
            $this->merge([
                'search' => [
                    'status' => false,
                    'complete_till' => $this->input('search.complete_till')
                ]
            ]);
        }
    }
}

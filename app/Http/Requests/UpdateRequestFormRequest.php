<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fname' => 'nullable|string',
            'mname' => 'nullable|string',
            'lname' => 'nullable|string',
            'doc_type' => 'nullable|string',
            'notes' => 'nullable|string',
            'action' => 'nullable|string',
            'origin_user' => 'nullable|string',
            'origin_division' => 'nullable|string',
            'new_division' => 'nullable|string',
            'new_user' => 'nullable|string',
            'urgent' => 'nullable|string',
        ];
    }
}

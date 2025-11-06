<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCreateFormRequest extends FormRequest
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
            'request_id' => 'nullable|string',
            'fname' => 'required|string',
            'mname' => 'required|string',
            'lname' => 'required|string',
            'doc_type' => 'required|string',
            'notes' => 'required|string',
            'status' => 'required|string',
            'origin_user' => 'nullable|string',
            'origin_division' => 'nullable|string',
            'new_division' => 'nullable|string',
            'new_user' => 'nullable|string',
            'urgent' => 'nullable|string',

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffCreateFormRequest extends FormRequest
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
            'request_id' => 'required|date',
            'fname' => 'required|string',
            'mname' => 'required|string',
            'lname' => 'required|string',
            'doc_type' => 'required|string',
            'notes' => 'required|string',
            'action' => 'required|string',
            'origin_user' => 'required|string',
            'origin_division' => 'required|string',
            'new_division' => 'required|string',
            'new_user' => 'required|string',
            'urgent' => 'nullable|string',
        ];
    }
}

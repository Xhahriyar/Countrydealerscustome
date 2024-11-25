<?php

namespace App\Http\Requests\SalesOfficer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreSalesOfficerRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        return [
            "first_name" => "required|max:50",
            "last_name" => "required|max:50",
            "email" => "nullable|email",
            "contact_no" => "required|string|min:11|max:20|regex:/^[0-9+\-\s()]+$/",
            "cnic" => "required|digits:13|regex:/^[0-9]+$/",
            "officer_type" => "required",
            "designation" => "required",
            "joining_date" => "required|date",
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AddOfficeEmployeeRequest extends FormRequest
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
            "bank_name" => "required",
            "account_number" => "required",
            "cnic" => "required|digits:13|regex:/^[0-9]+$/",
            "previous_experience" => "required|max:255",
            "salary" => "required|integer",
            "designation" => "required",
            "department" => "required",
            "gender" => "required|max:32",
            "date_of_birth" => "required",
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cnic_front_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cnic_back_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'father_cnic_front_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'father_cnic_back_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cv' => 'nullable|file|mimes:docx,txt,pdf|max:2048'

        ];
    }
}

<?php

namespace App\Http\Requests\ClientInstallment;

use Illuminate\Foundation\Http\FormRequest;

class InstallmentStatusUpdateRequest extends FormRequest
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
            'date' => 'required|date',
            'payment_type' => 'nullable',
            'receipt_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}

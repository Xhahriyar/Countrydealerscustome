<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
            'name' => 'required',
            'date' => 'required|date',
            'amount' => 'required|integer',
            'description' => 'nullable|max:255',
            'expense_type' => 'required',
            'expense_category' => 'required',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}

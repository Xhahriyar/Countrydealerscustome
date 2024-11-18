<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            "name" => "required",
            "plot_size" => "required",
            "cnic" => "required",
            "email" => "nullable",
            "contact_no" => "required",
            "father_or_husband_name" => "required",
            "paid_by" => "required",
            "plot_number" => "required",
            "address" => "required",
            "plot_sale_price" => "required",
            "client_type" => "required",
            "sale_type" => "required",
            "date" => "required|date",
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
    public function rules(Request $request): array
    {
        return [
            "name" => "required",
            "email" => "nullable|email",
            "contact_no" => "required|string|min:11|max:20|regex:/^[0-9+\-\s()]+$/",
            "cnic" => "nullable|digits:13|regex:/^[0-9]+$/",
            "father_or_husband_name" => "required",
            "client_type" => "required",
            "sale_type" => "required",
            "paid_by" => "required",
            "plot_size" => "required",
            "plot_number" => "required",
            "address" => "required",
            "plot_sale_price" => "required|integer|min:0",
            "date" => "required|date",
            "vehicles_adjustment" => "nullable|string",
            "adjustment_price" => "nullable|integer|min:0",
            "advance_payment" => "nullable|integer|min:0",
            "adjustment_product" => "nullable|string",
            "adjustment_product" => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sales_officer_id' => 'nullable',
            'commission_type' => 'nullable',
            'commission_amount' => 'nullable',
            'other_owner_name' => 'nullable',
            'other_owner_email' => 'nullable',
            'other_owner_number' => 'nullable',
            'other_owner_father_or_husband_name' => 'nullable',
        ];
    }
}

<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest
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
            'name' => [
                'required',
                'max:200',
                Rule::unique('roles')->where(function ($query) {
                    return $query->where('guard_name', 'web'); 
                }),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'The name has already been taken for this guard name.',
        ];
    }
}

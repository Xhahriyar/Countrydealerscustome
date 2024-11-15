<?php

namespace App\Http\Requests\Users;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    
    public function rules(Request $request): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . \Auth::user()->id],
            // 'password' => ['required', 'string', 'min:8'],
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */

    public function messages()
    {
        return [
            // 'profile_image.uploaded' => 'The profile image must not exceed 2MB.',
        ];
    }
}

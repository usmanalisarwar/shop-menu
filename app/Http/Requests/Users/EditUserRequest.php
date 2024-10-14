<?php

namespace App\Http\Requests\Users;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = User::where('id',$this->id)->first();
        if(!$user){
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->id)->whereNull('deleted_at'),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',        // Minimum length of 8 characters// Must have a matching password confirmation field
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', // Requires at least one lowercase, one uppercase, and one digit
            ],
            'role_id' => 'required|exists:roles,id', // Adjust to your roles table name
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, and one digit.',
            'role_id.required' => 'The role field is required.',
            'role_id.exists' => 'The selected role is invalid.',
        ];
    }

    public function failedAuthorization()
    {
        // Custom message when authorization fails
        abort(401, 'Invalid Id');
    }
}

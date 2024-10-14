<?php

namespace App\Http\Requests\Users;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;


class DeleteUserRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'id' => [
                'required'
            ],
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The Id field is required.', // 'roles' is the name of your roles table
        ];
    }

    public function failedAuthorization()
    {
        // Custom message when authorization fails
        abort(401, 'Invalid Id');
    }
}

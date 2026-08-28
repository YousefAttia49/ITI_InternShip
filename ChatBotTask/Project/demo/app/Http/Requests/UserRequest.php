<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return  [
                "name" => "required|min:3|max:50|string",
                "email" => "required|email|unique:users,email," . $this->route('user'),
                "password" => "required|min:6|max:50|string"
            ];
    }

    public function messages():array{
        return [
                "name.required"=>"name is required",
                "name.min"=>"name must be at least 3 characters ",
                "email.required"=>"email is required",
                "email.email"=>"email must be a valid email",
                "email.unique"=>"email is already exist",
                "password.required"=>"password is required",
                "password.min"=>"password must be at least 6 characters ",
            ];
    }
}

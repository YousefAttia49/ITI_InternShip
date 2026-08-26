<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                "name" => "required|min:3|max:20|string|unique:categories,name," . $this->route('category'),
                "description" => "min:12|max:100|required|string"
            ];
    }

    public function messages():array{
        return [
                "name.required"=>"name is required",
                "name.min"=>"name must be at least 3 characters ",
                "name.unique"=>"name is already exist",
                "description.required"=>"description is required",
                "description.min"=>"description must be at least 12 characters ",
            ];
    }
}

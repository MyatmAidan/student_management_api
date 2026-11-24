<?php

namespace App\Http\Requests\Class;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:class_models,name'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The class name is required.',
            'name.unique'   => 'The class name has already been taken.',
        ];
    }
}

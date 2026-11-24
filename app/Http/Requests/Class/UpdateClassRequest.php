<?php

namespace App\Http\Requests\Class;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $classId = $this->route('id');

        return [
            'name' => ['required', 'string', 'max:255', "unique:class_models,name,{$classId}"],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The class name is required.',
            'name.string'   => 'The class name must be a string.',
            'name.max'      => 'The class name must not exceed 255 characters.',
            'name.unique'   => 'The class name has already been taken.',
        ];
    }
}

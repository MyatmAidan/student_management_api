<?php

namespace App\Http\Requests\Class;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
            'name.unique'   => 'The class name has already been taken.',
        ];
    }
}

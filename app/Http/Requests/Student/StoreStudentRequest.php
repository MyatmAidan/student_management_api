<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'class_id' => ['required', 'integer', 'exists:class_models,id'],
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:students,email'],
            'phone'    => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'class_id.required' => 'The class is required.',
            'class_id.exists'   => 'The selected class does not exist.',
            'name.required'     => 'The student name is required.',
            'email.required'    => 'The email address is required.',
            'email.email'       => 'The email address must be a valid email.',
            'email.unique'      => 'The email address has already been taken.',
        ];
    }
}

<?php

namespace App\Http\Requests\Student;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'class_id.integer'  => 'The class ID must be an integer.',
            'class_id.exists'   => 'The selected class does not exist.',
            'name.required'     => 'The student name is required.',
            'name.string'       => 'The student name must be a string.',
            'name.max'          => 'The student name must not exceed 255 characters.',
            'email.required'    => 'The email address is required.',
            'email.email'       => 'The email address must be a valid email.',
            'email.max'         => 'The email address must not exceed 255 characters.',
            'email.unique'      => 'The email address has already been taken.',
            'phone.string'      => 'The phone number must be a string.',
            'phone.max'         => 'The phone number must not exceed 255 characters.',
        ];
    }
}

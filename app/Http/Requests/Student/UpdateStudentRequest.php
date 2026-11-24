<?php

namespace App\Http\Requests\Student;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
        $studentId = $this->route('id');

        return [
            'class_id' => ['sometimes', 'integer', 'exists:class_models,id'],
            'name'     => ['sometimes', 'string', 'max:255'],
            'email'    => ['sometimes', 'email', 'max:255', "unique:students,email,{$studentId}"],
            'phone'    => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'class_id.integer'  => 'The class ID must be an integer.',
            'class_id.exists'   => 'The selected class does not exist.',
            'name.string'       => 'The student name must be a string.',
            'name.max'          => 'The student name must not exceed 255 characters.',
            'email.email'       => 'The email address must be a valid email.',
            'email.max'         => 'The email address must not exceed 255 characters.',
            'email.unique'      => 'The email address has already been taken.',
            'phone.string'      => 'The phone number must be a string.',
            'phone.max'         => 'The phone number must not exceed 255 characters.',
        ];
    }
}

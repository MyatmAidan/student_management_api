<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
            'class_id.exists' => 'The selected class does not exist.',
            'email.email'     => 'The email address must be a valid email.',
            'email.unique'    => 'The email address has already been taken.',
        ];
    }
}

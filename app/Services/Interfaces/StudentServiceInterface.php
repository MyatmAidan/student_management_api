<?php

namespace App\Services\Interfaces;

use App\Models\Student;
use Illuminate\Pagination\LengthAwarePaginator;

interface StudentServiceInterface
{
    public function getAllStudents(int $perPage = 15): LengthAwarePaginator;

    public function getStudentById(int $id): Student;

    public function createStudent(array $data): Student;

    public function updateStudent(int $id, array $data): Student;

    public function deleteStudent(int $id): bool;
}

<?php

namespace App\Services;

use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Services\Interfaces\StudentServiceInterface;
use App\Models\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentService implements StudentServiceInterface
{
    public function __construct(
        private readonly StudentRepositoryInterface $studentRepository
    ) {}

    public function getAllStudents(int $perPage = 15): LengthAwarePaginator
    {
        return $this->studentRepository->getAll($perPage);
    }

    public function getStudentById(int $id): Student
    {
        $student = $this->studentRepository->findById($id);

        if (! $student) {
            throw new ModelNotFoundException("Student with ID {$id} not found.");
        }

        return $student;
    }

    public function createStudent(array $data): Student
    {
        return $this->studentRepository->create($data);
    }

    public function updateStudent(int $id, array $data): Student
    {
        $student = $this->getStudentById($id);

        return $this->studentRepository->update($student, $data);
    }

    public function deleteStudent(int $id): bool
    {
        $student = $this->getStudentById($id);

        return $this->studentRepository->delete($student);
    }
}

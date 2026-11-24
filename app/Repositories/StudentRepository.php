<?php

namespace App\Repositories;

use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Models\Student;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentRepository implements StudentRepositoryInterface
{
    public function getAll(int $perPage = 15): LengthAwarePaginator
    {
        return Student::with('class')->paginate($perPage);
    }

    public function findById(int $id): ?Student
    {
        return Student::with('class')->find($id);
    }

    public function create(array $data): Student
    {
        $student = Student::create($data);

        return $student->load('class');
    }

    public function update(Student $student, array $data): Student
    {
        $student->update($data);

        return $student->fresh('class');
    }

    public function delete(Student $student): bool
    {
        return (bool) $student->delete();
    }
}

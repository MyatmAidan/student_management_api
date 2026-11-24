<?php

namespace App\Services;

use App\Repositories\Interfaces\ClassRepositoryInterface;
use App\Services\Interfaces\ClassServiceInterface;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class ClassService implements ClassServiceInterface
{
    public function __construct(
        private readonly ClassRepositoryInterface $classRepository
    ) {}

    public function getAllClasses(int $perPage = 15): LengthAwarePaginator
    {
        return $this->classRepository->getAll($perPage);
    }

    public function getClassById(int $id): ClassModel
    {
        $class = $this->classRepository->findById($id);

        if (! $class) {
            throw new ModelNotFoundException("Class with ID {$id} not found.");
        }

        return $class;
    }

    public function createClass(array $data): ClassModel
    {
        return $this->classRepository->create($data);
    }

    public function updateClass(int $id, array $data): ClassModel
    {
        $class = $this->getClassById($id);

        return $this->classRepository->update($class, $data);
    }

    public function deleteClass(int $id): bool
    {
        $class = $this->getClassById($id);

        return $this->classRepository->delete($class);
    }
}

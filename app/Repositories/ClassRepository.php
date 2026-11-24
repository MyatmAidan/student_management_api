<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ClassRepositoryInterface;
use App\Models\ClassModel;
use Illuminate\Pagination\LengthAwarePaginator;

class ClassRepository implements ClassRepositoryInterface
{
    public function getAll(int $perPage = 15): LengthAwarePaginator
    {
        return ClassModel::withCount('students')->paginate($perPage);
    }

    public function findById(int $id): ?ClassModel
    {
        return ClassModel::withCount('students')->find($id);
    }

    public function create(array $data): ClassModel
    {
        return ClassModel::create($data);
    }

    public function update(ClassModel $class, array $data): ClassModel
    {
        $class->update($data);

        return $class->fresh();
    }

    public function delete(ClassModel $class): bool
    {
        return (bool) $class->delete();
    }
}

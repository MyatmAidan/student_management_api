<?php

namespace App\Repositories\Interfaces;

use App\Models\ClassModel;
use Illuminate\Pagination\LengthAwarePaginator;

interface ClassRepositoryInterface
{
    public function getAll(int $perPage = 15): LengthAwarePaginator;

    public function findById(int $id): ?ClassModel;

    public function create(array $data): ClassModel;

    public function update(ClassModel $class, array $data): ClassModel;

    public function delete(ClassModel $class): bool;
}

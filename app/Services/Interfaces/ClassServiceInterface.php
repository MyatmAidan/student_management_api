<?php

namespace App\Services\Interfaces;

use App\Models\ClassModel;
use Illuminate\Pagination\LengthAwarePaginator;

interface ClassServiceInterface
{
    public function getAllClasses(int $perPage = 15): LengthAwarePaginator;

    public function getClassById(int $id): ClassModel;

    public function createClass(array $data): ClassModel;

    public function updateClass(int $id, array $data): ClassModel;

    public function deleteClass(int $id): bool;
}

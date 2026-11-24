<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Class\StoreClassRequest;
use App\Http\Requests\Class\UpdateClassRequest;
use App\Http\Resources\ClassResource;
use App\Http\Responses\ApiResponse;
use App\Services\Interfaces\ClassServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ClassController extends Controller
{
    public function __construct(
        private readonly ClassServiceInterface $classService
    ) {}

    public function index(): JsonResponse
    {
        $classes = $this->classService->getAllClasses();

        return ApiResponse::success(
            ClassResource::collection($classes)->response()->getData(true),
            'Classes retrieved successfully'
        );
    }

    public function store(StoreClassRequest $request): JsonResponse
    {
        $class = $this->classService->createClass($request->validated());

        return ApiResponse::created(
            new ClassResource($class),
            'Class created successfully'
        );
    }

    public function show(int $id): JsonResponse
    {
        try {
            $class = $this->classService->getClassById($id);

            return ApiResponse::success(
                new ClassResource($class),
                'Class retrieved successfully'
            );
        } catch (ModelNotFoundException $e) {
            return ApiResponse::notFound($e->getMessage());
        }
    }

    public function update(UpdateClassRequest $request, int $id): JsonResponse
    {
        try {
            $class = $this->classService->updateClass($id, $request->validated());

            return ApiResponse::success(
                new ClassResource($class),
                'Class updated successfully'
            );
        } catch (ModelNotFoundException $e) {
            return ApiResponse::notFound($e->getMessage());
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->classService->deleteClass($id);

            return ApiResponse::noContent('Class deleted successfully');
        } catch (ModelNotFoundException $e) {
            return ApiResponse::notFound($e->getMessage());
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Cannot delete class. It may have students enrolled.',
                null,
                409
            );
        }
    }
}

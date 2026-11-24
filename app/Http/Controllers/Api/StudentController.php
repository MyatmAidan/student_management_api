<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Http\Responses\ApiResponse;
use App\Services\Interfaces\StudentServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    public function __construct(
        private readonly StudentServiceInterface $studentService
    ) {}

    public function index(): JsonResponse
    {
        $students = $this->studentService->getAllStudents();

        return ApiResponse::success(
            StudentResource::collection($students)->response()->getData(true),
            'Students retrieved successfully'
        );
    }

    public function store(StoreStudentRequest $request): JsonResponse
    {
        $student = $this->studentService->createStudent($request->validated());

        return ApiResponse::created(
            new StudentResource($student),
            'Student created successfully'
        );
    }

    public function show(int $id): JsonResponse
    {
        try {
            $student = $this->studentService->getStudentById($id);

            return ApiResponse::success(
                new StudentResource($student),
                'Student retrieved successfully'
            );
        } catch (ModelNotFoundException $e) {
            return ApiResponse::notFound($e->getMessage());
        }
    }

    public function update(UpdateStudentRequest $request, int $id): JsonResponse
    {
        try {
            $student = $this->studentService->updateStudent($id, $request->validated());

            return ApiResponse::success(
                new StudentResource($student),
                'Student updated successfully'
            );
        } catch (ModelNotFoundException $e) {
            return ApiResponse::notFound($e->getMessage());
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->studentService->deleteStudent($id);

            return ApiResponse::noContent('Student deleted successfully');
        } catch (ModelNotFoundException $e) {
            return ApiResponse::notFound($e->getMessage());
        }
    }
}

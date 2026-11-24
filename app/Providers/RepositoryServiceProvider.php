<?php

namespace App\Providers;

use App\Repositories\Interfaces\ClassRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Services\Interfaces\ClassServiceInterface;
use App\Services\Interfaces\StudentServiceInterface;
use App\Repositories\ClassRepository;
use App\Repositories\StudentRepository;
use App\Services\ClassService;
use App\Services\StudentService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Repositories
        $this->app->bind(ClassRepositoryInterface::class, ClassRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);

        // Services
        $this->app->bind(ClassServiceInterface::class, ClassService::class);
        $this->app->bind(StudentServiceInterface::class, StudentService::class);
    }

    public function boot(): void {}
}

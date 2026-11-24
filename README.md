# Student Management API

A RESTful API built with **Laravel 13** for managing classes and students. Uses a repository-service pattern with Eloquent ORM and MySQL.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 13 |
| Language | PHP 8.3 |
| Database | MySQL |
| Architecture | Repository → Service → Controller |
| Response | Unified `ApiResponse` wrapper |

---

## Requirements

- PHP 8.3+
- Composer
- MySQL (running on port `3308` by default)

---

## Project Setup

### 1. Clone & install dependencies

```bash
cd student-management-api
composer install
```

### 2. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3308
DB_DATABASE=student_management
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Run migrations

```bash
php artisan migrate
```

### 4. Start the development server

```bash
php artisan serve
```

API is now available at **http://localhost:8000**

---

## API Endpoints

Base URL: `http://localhost:8000/api`

### Classes

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/classes` | List all classes (paginated) |
| `POST` | `/classes` | Create a class |
| `GET` | `/classes/{id}` | Get a single class |
| `PUT` | `/classes/{id}` | Update a class |
| `DELETE` | `/classes/{id}` | Delete a class |

### Students

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/students` | List all students (paginated) |
| `POST` | `/students` | Create a student |
| `GET` | `/students/{id}` | Get a single student |
| `PUT` | `/students/{id}` | Update a student |
| `DELETE` | `/students/{id}` | Delete a student |

---

## Request & Response Examples

### Create a Class

**Request**
```json
POST /api/classes
{
  "name": "Grade 10-A"
}
```

**Response**
```json
{
  "success": true,
  "message": "Class created successfully",
  "data": {
    "id": 1,
    "name": "Grade 10-A",
    "students_count": 0,
    "created_at": "2024-01-01 09:00:00",
    "updated_at": "2024-01-01 09:00:00"
  }
}
```

### Create a Student

**Request**
```json
POST /api/students
{
  "class_id": 1,
  "name": "John Doe",
  "email": "john@example.com",
  "phone": "+95 9 123 456 789"
}
```

**Response**
```json
{
  "success": true,
  "message": "Student created successfully",
  "data": {
    "id": 1,
    "class_id": 1,
    "class": { "id": 1, "name": "Grade 10-A" },
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "+95 9 123 456 789",
    "created_at": "2024-01-01 09:00:00",
    "updated_at": "2024-01-01 09:00:00"
  }
}
```

### List Response (Paginated)

```json
{
  "success": true,
  "message": "Classes retrieved successfully",
  "data": {
    "data": [ { "id": 1, "name": "Grade 10-A", ... } ],
    "current_page": 1,
    "last_page": 1,
    "per_page": 15,
    "total": 1
  }
}
```

---

## Project Structure

```
app/
├── Http/
│   ├── Controllers/Api/     # ClassController, StudentController
│   ├── Requests/            # Form request validation
│   │   ├── Class/           # StoreClassRequest, UpdateClassRequest
│   │   └── Student/         # StoreStudentRequest, UpdateStudentRequest
│   ├── Resources/           # ClassResource, StudentResource (JSON transformers)
│   └── Responses/           # ApiResponse (unified response helper)
├── Models/                  # ClassModel, Student
├── Repositories/            # ClassRepository, StudentRepository
│   └── Interfaces/          # ClassRepositoryInterface, StudentRepositoryInterface
├── Services/                # ClassService, StudentService
│   └── Interfaces/          # ClassServiceInterface, StudentServiceInterface
└── Providers/
    └── RepositoryServiceProvider.php   # Binds interfaces to implementations
routes/
└── api.php                  # All API routes
config/
└── cors.php                 # CORS config (allows http://localhost:3000)
```

---

## CORS

The API allows requests from `http://localhost:3000` by default (the frontend dev server). To change allowed origins, edit `config/cors.php`:

```php
'allowed_origins' => ['http://localhost:3000'],
```

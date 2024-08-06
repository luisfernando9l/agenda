<?php

namespace App\Http\Controllers\Api;

use Inertia\Inertia;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Services\DepartmentService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\DepartmentResource;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    protected $service;

    public function __construct(DepartmentService $service)
    {
        $this->service = $service;
    }

    public function getDepartments(Department $department, Request $request)
    {
        // Gate::authorize('departmentList', User::class);
        return response(
            DepartmentResource::collection(
                $this->service->getDepartments($request)
            )->response()->getData(true),
            200
        );
    }
}
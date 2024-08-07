<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Department;
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

    public function index()
    {
        // Gate::authorize('list', Department::class);
        return Inertia::render('Department/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Gate::authorize('newDepartment', User::class);
        return Inertia::render('Department/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        // Gate::authorize('newDepartment, User::class);
        if($this->service->store($request)){
            return redirect()->route('departments')->withSuccess("Departamento criado com sucesso");
        }
        return redirect()->back()->withError("Erro ao criar departamento");
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        // Gate::authorize('viewDepartment', $user);
        return Inertia::render('Department/Show')->with([
            'department' => DepartmentResource::make($department)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        // Gate::authorize('updateDepartment', $user);
        return Inertia::render('Department/Edit')->with([
            'department' => DepartmentResource::make($department)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        // Gate::authorize('updateDepartment', $user);
        if($this->service->update($request, $department)){
            return redirect()->route('departments')->withSuccess("Departamento criado com sucesso");
            return response('', 500);
        }
        return redirect()->back()->withError("Erro ao atualizar departamento");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        // Gate::authorize('updateDepartment', $user);
        if(!$this->service->canDeleteDepartment($department)){
            return redirect()->back()->withError("Não é possível apagar um departamento com usuários");
        }
        if($this->service->destroy($department)){
            return redirect()->route('departments')->withSuccess("Departamento deletado com sucesso");
        }
        return redirect()->back()->withError("Erro ao deletar departamento");
    }
}

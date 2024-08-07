<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Department;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        // Gate::authorize('list', User::class);
        return Inertia::render('User/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Gate::authorize('newUser', User::class);
        $departments = Department::all();
        return Inertia::render('User/Create', [
            'departments' => $departments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // Gate::authorize('newUser, User::class);
        if($this->service->store($request)){
            return redirect()->route('users')->withSuccess("Usuário criado com sucesso!");
        }
        return redirect()->back()->withError("Erro ao criar usuário");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Gate::authorize('viewUser', $user);
        return Inertia::render('User/Show')->with([
            'user' => UserResource::make($user)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Gate::authorize('updateUser', $user);
        $departments = Department::all();
        return Inertia::render('User/Edit')->with([
            'departments' => $departments,
            'user' => UserResource::make($user)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // Gate::authorize('updateUser', $user);
        if($this->service->update($request, $user)){
            return redirect()->route('users')->withSuccess("Usuário atualizado com sucesso!");
        }
        return redirect()->back()->withError("Erro ao atualizar usuário");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Gate::authorize('updateUser', $user);
        if(!$this->service->canDeleteUser($user)){
            return redirect()->back()->withError("Não é possível apagar o usuário pois existem departamentos relacionados");
        }
        if($this->service->destroy($user)){
            return redirect()->route('users')->withSuccess("Usuário deletado com sucesso!");
        }
        return redirect()->back()->withError("Erro ao deletar usuário");
    }
}

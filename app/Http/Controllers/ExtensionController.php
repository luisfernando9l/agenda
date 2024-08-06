<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Extension;
use App\Services\ExtensionService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\ExtensionResource;
use App\Http\Requests\StoreExtensionRequest;
use App\Http\Requests\UpdateExtensionRequest;

class ExtensionController extends Controller
{
    protected $service;

    public function __construct(ExtensionService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        // Gate::authorize('list', Extension::class);
        return Inertia::render('Extension/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Gate::authorize('newExtension', User::class);
        $users = User::all();
        return Inertia::render('Extension/Create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExtensionRequest $request)
    {
        // Gate::authorize('newExtension, User::class);
        if($this->service->store($request)){
            return redirect()->route('extensions')->withSuccess("Ramal criado com sucesso");
        }
        return redirect()->back()->withError("Erro ao criar ramal");
    }

    /**
     * Display the specified resource.
     */
    public function show(Extension $extension)
    {
        // Gate::authorize('viewExtension', $user);
        return Inertia::render('Extension/Show')->with([
            'extension' => ExtensionResource::make($extension)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Extension $extension)
    {
        // Gate::authorize('updateExtension', $user);
        return Inertia::render('Extension/Edit')->with([
            'extension' => ExtensionResource::make($extension)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExtensionRequest $request, Extension $extension)
    {
        // Gate::authorize('updateExtension', $user);
        if($this->service->update($request, $extension)){
            return redirect()->route('extensions')->withSuccess("Ramal criado com sucesso");
        }
        return redirect()->back()->withError("Erro ao atualizar ramal");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Extension $extension)
    {
        // Gate::authorize('updateExtension', $user);
        if($this->service->destroy($extension)){
            return redirect()->route('extensions')->withSuccess("Ramal deletado com sucesso");
        }
        return redirect()->back()->withError("Erro ao deletar ramal");
    }
}

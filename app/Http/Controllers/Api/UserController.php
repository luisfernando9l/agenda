<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function getUsers(User $user, Request $request)
    {
        // Gate::authorize('userList', User::class);
        return response(
            UserResource::collection(
                $this->service->getUsers($request)
            )->response()->getData(true),
            200
        );
    }
}
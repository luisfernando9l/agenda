<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function index()
    {
        return Inertia::render('Auth/Login');
    }

    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    public function store(UserRequest $request)
    {
        if($user = (new UserService())->newSystemUser($request))
        {
            return response(UserResource::make($user), 201);
        }
        return response('', 500);
    }

    public function login(LoginRequest $request)
    {
        if($res = (new UserService())->login($request))
        {
            if(!isset($res['user']))
                return response('',$res['status_code']);

            return response([
                'user' => UserResource::make($res['user']),
                'token' => $res['token']
            ], );
        }
        return response('', 500);
    }
}

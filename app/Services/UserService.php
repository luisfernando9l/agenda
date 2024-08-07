<?php

namespace App\Services;

use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function store($request)
    {
        $password = $request->password ? $request->password : Str::random(10);

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'department_id' => $request->department_id ?? NULL,
            // 'level' => $request->level,
        ]);
        // enviar email com nova senha
    }

    public function update($request, $user)
    {
        return $user->update($request->all());
    }

    public function destroy($user)
    {
        return $user->delete();
    }

    public function canDeleteUser($user)
    {
        if($user->department()->exists()){
            return false;
        }

        $departmentsCreatedByUser = Department::where('created_by', $user->id)->exists();
        if($departmentsCreatedByUser){
            return false;
        }
        return true;
    }

    public function getUsers($request)
    {
        return User::query()
            ->leftJoin('extensions', 'users.id', 'extensions.user_id')
            ->leftJoin('departments', 'users.department_id', 'departments.id')
            ->when($request->input('name'), function($query, $name) {
                $query->where('users.name', 'like', "%{$name}%");
            })
            ->when($request->input('extension'), function($query, $extension) {
                $query->where('extensions.number', 'like', "%{$extension}%");
            })
            ->when($request->input('department'), function($query, $department) {
                $query->where('departments.name', 'like', "%{$department}%");
            })
            ->select('users.*')
            ->paginate(10);
    }
}
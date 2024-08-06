<?php

namespace App\Services;

use App\Models\User;
use App\Models\Department;

class DepartmentService
{
    public function store($request)
    {
        return Department::create([
            'name' => $request->name,
            'created_by' => auth()->user()->id
        ]);
    }

    public function update($request, $department)
    {
        return $department->update($request->all());
    }

    public function destroy($department)
    {
        $users = User::where('department_id', $department->id)->count();
        if($users <= 0){
            return $department->delete();
        }
        return false;
    }

    public function getDepartments($request)
    {
        return Department::query()
            ->when($request->input('name'), function($query, $name){
                $query->where('name', 'like', "%{$name}%");
            })
            ->paginate(10);
    }
}
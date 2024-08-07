<?php

namespace App\Services;

use App\Models\Extension;

class ExtensionService
{
    public function store($request)
    {
        return Extension::create([
            'number' => $request->number,
            'user_id' => $request->user_id,
        ]);
    }

    public function update($request, $extension)
    {
        $extension->number = $request->number;
        $extension->user_id = $request->user_id ?? NULL;
        return $extension->update();
    }

    public function destroy($extension)
    {
        return $extension->delete();
    }

    public function getExtensions($request)
    {
        return Extension::query()
            ->leftJoin('users', 'extensions.user_id', 'users.id')
            ->leftJoin('departments', 'users.department_id', 'departments.id')
            ->when($request->input('number'), function ($query, $number) {
                $query->where('extensions.number', 'like', "%{$number}%");
            })
            ->when($request->input('owner'), function ($query, $owner) {
                $query->where('users.name', 'like', "%{$owner}%");
            })
            ->when($request->input('department'), function ($query, $department) {
                $query->where(function ($query) use ($department) {
                    $query->where('departments.name', 'like', "%{$department}%")
                        ->orWhereNull('departments.name');
                });
            })
            ->select('extensions.*')
            ->paginate(10);
    }
}
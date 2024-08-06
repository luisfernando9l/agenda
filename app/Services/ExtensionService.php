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
        return $extension->update($request->all());
    }

    public function destroy($extension)
    {
        return $extension->delete();
    }

    public function getExtensions($request)
    {
        return Extension::query()
            ->when($request->input('number'), function($query, $number){
                $query->where('number', 'like', "%{$number}%");
            })
            //verificar user
            ->paginate(10);
    }
}
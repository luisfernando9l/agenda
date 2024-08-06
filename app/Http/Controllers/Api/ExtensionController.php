<?php

namespace App\Http\Controllers\Api;

use App\Models\Extension;
use Illuminate\Http\Request;
use App\Services\ExtensionService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\ExtensionResource;

class ExtensionController extends Controller
{
    protected $service;

    public function __construct(ExtensionService $service)
    {
        $this->service = $service;
    }

    public function getExtensions(Extension $extension, Request $request)
    {
        // Gate::authorize('extensionList', User::class);
        return response(
            ExtensionResource::collection(
                $this->service->getExtensions($request)
            )->response()->getData(true),
            200
        );
    }
}
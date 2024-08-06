<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        // if (Gate::allows('dashboard'))
        return Inertia::render('Dashboard');
    }
}

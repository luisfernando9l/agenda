<?php

namespace App\Providers;

use App\Models\Functionality;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Inertia::share('flash', function(){
            return [
                'success' => Session::get('success'),
                'error' => Session::get('error'),
            ];
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('settings', function () {
            // return Functionality::canAccess("Configuracoes");
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use function base_path;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Route::middleware(['web'])
            ->prefix('admin')
            ->group(base_path('routes/backend.php'));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

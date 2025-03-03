<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * @var string|null
     */
    protected $namespace = 'App\Http\Controllers\Admin';


    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        parent::boot();

        $this->routes(function () {
            // Routes untuk website utama
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Routes untuk admin
            Route::middleware('web') // Sesuaikan middleware jika perlu
                ->prefix('admin') // Jika ingin semua route admin diawali dengan /admin
                ->group(base_path('routes/admin.php'));

            // Routes API jika ada
            // Route::middleware('api')
            //     ->prefix('api')
            //     ->group(base_path('routes/api.php'));
        });
    }
}

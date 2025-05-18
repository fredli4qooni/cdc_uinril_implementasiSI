<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     * Typically, users are redirected here after authentication.
     * Ini untuk MAHASISWA setelah login/register default Breeze.
     * @var string
     */
    public const HOME = '/mahasiswa/dashboard';

     /**
     * Path untuk redirect Admin setelah login atau jika akses halaman guest.
     * @var string
     */
    public const ADMIN_HOME = '/admin/dashboard'; // <-- Tambahkan ini

     /**
     * Path untuk redirect Perusahaan setelah login atau jika akses halaman guest.
     * @var string
     */
    public const COMPANY_HOME = '/perusahaan/dashboard'; // <-- Tambahkan ini


    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        // ... (Rate Limiter)

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
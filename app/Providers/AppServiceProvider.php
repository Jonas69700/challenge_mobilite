<?php

namespace App\Providers;

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(UrlGenerator $url): void
    {
        Route::aliasMiddleware('admin', AdminMiddleware::class);
        
        if (env('APP_ENV') == 'production') {
            $url->forceScheme('https');
        }
    }
}

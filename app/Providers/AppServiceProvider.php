<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DolarService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Registro manual del DolarService para inyección de dependencias
        $this->app->bind(DolarService::class, function ($app) {
            return new DolarService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

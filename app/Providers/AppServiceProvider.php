<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FoursquareService; // 

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(FoursquareService::class, function ($app) {
            return new FoursquareService();
        });
    }

    public function boot(): void
    {
        //
    }
}

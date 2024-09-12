<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Adapters\hotelLegsServiceAdapter;

class AdapterServiceProvider extends ServiceProvider
{
    public function register()
    {
        print_r("here");
        $this->app->singleton('serviceAdapters', function ($app) {
            return [
                new hotelLegsServiceAdapter(),
                // Add more adapters here
            ];
        });
    }
}

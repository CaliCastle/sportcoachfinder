<?php

namespace SCF\Providers;

use SCF\Models\Site;
use SCF\Library\Location;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Site', function () {
            return new Site;
        });

        $this->app->singleton('Location', function () {
            return new Location;
        });
    }
}

<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.card', 'card');
        Blade::component('components.alert', 'alert');
        config(['app.locale' => 'id']);
	    Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
    }
}

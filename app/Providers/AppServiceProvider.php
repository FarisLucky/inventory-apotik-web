<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
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
        // Default String Length in Databases
        Schema::defaultStringLength(191);

        // Time Zone
        date_default_timezone_set('Asia/Jakarta');

        //Gate::define('admin', function ($user) {
        //    return $user->jabatan == 'admin';
        //});
        //Gate::define('karyawan', function ($user) {
        //    return $user->jabatan == 'karyawan';
        //});
    }
}

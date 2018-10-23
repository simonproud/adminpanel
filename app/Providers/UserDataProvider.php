<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use Illuminate\Support\Facades\View;

class UserDataProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer(
            '*', 'App\Http\ViewComposers\UserDataComposer'
        );

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }
}

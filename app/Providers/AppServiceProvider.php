<?php

namespace App\Providers;

use App\Models\Fun;
use App\Models\Role;
use Facade\FlareClient\View;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        view()->composer('backend.widgets.menu-left', function ($view) {
            $menus = Fun::_listmenu(Auth::user()->id);
            //dd($menus);
            view()->share('menus', $menus);
        });
    }
}

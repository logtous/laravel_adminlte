<?php

namespace App\Providers;

use App\Models\Permission;
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
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.app', function ($view) {
            $menus = Permission::with(['childs'])->where('parent_id', 0)->orderBy('sort')->get();
            $view->with('menus', $menus);
        });
    }
}

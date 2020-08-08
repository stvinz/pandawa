<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

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
        // Header Menu Categories
        $categories = DB::table('categories')->select('name')->orderBy('name', "asc")->get();
        $materials = DB::table('materials')->select('name')->orderBy('name', "asc")->get();

        View::share('categories', json_encode($categories));
        View::share('materials', json_encode($materials));
    }
}

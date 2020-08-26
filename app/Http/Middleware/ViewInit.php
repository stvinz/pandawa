<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ViewInit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Header Menu Categories
        $categories = DB::table('categories')->select('name', 'img')->orderBy('name', "asc")->get();
        $materials = DB::table('materials')->select('name', 'img')->orderBy('name', "asc")->get();

        View::share('categories', json_encode($categories));
        View::share('materials', json_encode($materials));

        return $next($request);
    }
}

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Dynamic routes
Route::get('product', 'ProductController@getProduct');

Route::get('contact-us', 'ContactController@show');
Route::post('contact-us', 'ContactController@submit');

// Static routes
Route::get('about', function() {
    return view('pages.about');
});

Route::get('home', function() {
    return view('pages.welcome');
});

Route::any('{any?}', function () {
    return abort(404);
})->where('any', '.*');

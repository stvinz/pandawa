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
Route::get('product', 'ProductController@getProduct');

Route::get('about', function() {
    return view('pages.about');
});

Route::get('contact-us', function() {
    return view('pages.contact');
});

Route::get('home', function() {
    return view('pages.welcome');
});

Route::any('{any?}', function () {
    return redirect('/home');
})->where('any', '.*');

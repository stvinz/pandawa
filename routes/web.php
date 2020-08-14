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

/*------------------------
    Dvelepoment features
--------------------------*/
if (!app()->environment('production')) {
    Route::get('dev/cats', 'DevController@getCats');
    Route::get('dev/mats', 'DevController@getMats');
    Route::get('dev/prods', 'DevController@getProds');
    
    Route::post('dev/prods', 'DevController@postProds');
}

/*------------------ 
    Dynamic routes
--------------------*/
// Parameter routes
//Route::get('product/details', 'ProductController@get');

// Query routes
// Route::get('product/{name}', 'ProductController@getSingleProduct');
Route::get('product', 'ProductController@getProduct');

/*----------------- 
    Static routes
-------------------*/
// Routes that requires custom data transfer
Route::get('contact-us', 'ContactController@show');
Route::post('contact-us', 'ContactController@submit');

// Routes that only need global data
Route::get('about', function() {
    return view('pages.about');
});

Route::get('material-list', function() {
    return view('pages.materialList');
});

Route::get('product-list', function() {
    return view('pages.productList');
});

// Default page
Route::get('home', function() {
    return view('pages.welcome');
});

// For unknown routes, redirect to home
Route::any('{any?}', function () {
    // return redirect('home');
    return abort(404);
})->where('any', '.*');

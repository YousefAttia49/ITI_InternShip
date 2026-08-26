<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name("home");




//==================== Auth ===============

route::get("/login",[AuthController::class,'showLoginForm'])->name("login");
route::post("/login",[AuthController::class,'login'])->name("login.submit");
route::get("/register",[AuthController::class,'showRegisterForm'])->name("register");
route::post("/register",[AuthController::class,'register'])->name("register.submit");
route::post("/logout",[AuthController::class,'logout'])->name("logout");



//==================== Protected Admin Routes (auth + admin) ===============
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource("users", UserController::class);
    Route::resource("categories", CategoryController::class);
});


//==================== Protected User Routes (auth) ===============
Route::middleware(['auth'])->group(function () {
    Route::resource("products", ProductController::class);
    Route::resource("orders", OrderController::class);
});



// list all routes : php artisan route:list
/**                   url                                           route name                 function
 *  GET|HEAD        categories .................................... categories.index › CategoryController@index
 *  POST            categories .................................... categories.store › CategoryController@store
*   GET|HEAD        categories/create ........................... categories.create › CategoryController@create
*   GET|HEAD        categories/{category} ........................... categories.show › CategoryController@show
*   PUT|PATCH       categories/{category} ....................... categories.update › CategoryController@update
*   DELETE          categories/{category} ..................... categories.destroy › CategoryController@destroy
*   GET|HEAD        categories/{category}/edit ...................... categories.edit › CategoryController@edit
*                      --------------------------------
*   GET|HEAD        users .................................................. users.index › UserController@index
*   POST            users .................................................. users.store › UserController@store
*   GET|HEAD        users/create ......................................... users.create › UserController@create
*   GET|HEAD        users/{user} ........................................... users.show › UserController@show
*   PUT|PATCH       users/{user} ....................................... users.update › UserController@update
*   DELETE          users/{user} ..................................... users.destroy › UserController@destroy
*   GET|HEAD        users/{user}/edit .................................... users.edit › UserController@edit
*                      --------------------------------
*   GET|HEAD        products ......................................... products.index › ProductController@index
*   POST            products ......................................... products.store › ProductController@store
*   GET|HEAD        products/create ................................ products.create › ProductController@create
*   GET|HEAD        products/{product} ............................... products.show › ProductController@show
*   PUT|PATCH       products/{product} ........................... products.update › ProductController@update
*   DELETE          products/{product} ......................... products.destroy › ProductController@destroy
*   GET|HEAD        products/{product}/edit .......................... products.edit › ProductController@edit
*                      --------------------------------
*   GET|HEAD        orders ............................................. orders.index › OrderController@index
*   POST            orders ............................................. orders.store › OrderController@store
*   GET|HEAD        orders/create .................................... orders.create › OrderController@create
*   GET|HEAD        orders/{order} ...................................... orders.show › OrderController@show
*   PUT|PATCH       orders/{order} .................................. orders.update › OrderController@update
*   DELETE          orders/{order} ................................ orders.destroy › OrderController@destroy
*   GET|HEAD        orders/{order}/edit ................................ orders.edit › OrderController@edit
 *
 */

<?php

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

// Home
Route::get('/', 'HomeController@getHome')->name('home');

// Auth endpoint, when user is logged out
Route::group(["middleware" => "guest"], function() {
    
    // Registration
    Route::get("register", "Auth\RegisterController@getRegister")->name("auth.register");
    Route::post("register", "Auth\RegisterController@postRegister")->name("auth.register.post");

    // Login
    Route::get("login", "Auth\LoginController@getLogin")->name("auth.login");
    Route::post("login", "Auth\LoginController@postLogin")->name("auth.login.post");

});

// Auth endpoints, when user is logged in
Route::group(["middleware" => "user"], function() {

    // Logout
    Route::get("logout", "Auth\LogoutController@getLogout")->name("auth.logout");

});


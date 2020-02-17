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
Route::get("/", "HomeController@getHome")->name("home");

Route::get("test", "StaticPageController@getStaticPage")->name("static");

// Auth endpoints, when user is logged in
Route::group(["middleware" => "auth"], function() {

    // Search
    Route::get("zoeken", "SearchController@getSearch")->name("search");
    Route::post("zoeken", "SearchController@postSearch")->name("search.post");

});

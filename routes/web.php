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

// Homepage
Route::get("/", "HomeController@getHome")->name("home");

// Static pages
Route::get("pers", "StaticPageController@getPress")->name("press");
Route::get("partners", "StaticPageController@getPartners")->name("partners");
Route::get("over-hnnw", "StaticPageController@getAbout")->name("about");
Route::get("doe-meer", "StaticPageController@getDoMore")->name("do-more");

// Faq pages
Route::get("veelgestelde-vragen", "FaqController@getOverview")->name("faq");

// Contact pages
Route::get("contact", "ContactController@getContact")->name("contact");
Route::post("contact", "ContactController@postContact")->name("contact.post");

// Auth endpoints, when user is logged in
Route::group(["middleware" => "auth"], function() {

    // Search
    Route::get("zoeken", "SearchController@getSearch")->name("search");
    Route::post("zoeken", "SearchController@postSearch")->name("search.post");

});

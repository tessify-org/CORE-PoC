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
Route::group(["middleware" => "auth"], function() {

    // Logout
    Route::get("uitloggen", "Auth\LogoutController@getLogout")->name("auth.logout");

});

// Search
Route::get("zoeken", "SearchController@getSearch")->name("search");
Route::post("zoeken", "SearchController@postSearch")->name("search.post");

// Memberlist
Route::get("ledenlijst", "Profiles\MemberlistController@getMemberList")->name("memberlist");

// Update profiel
Route::get("profiel/updaten", "Profiles\ProfileController@getUpdateProfile")->name("profile.update");
Route::post("profiel/updaten", "Profiles\ProfileController@postUpdateProfile")->name("profile.update.post");

// Profiel
Route::get("profiel/{slug?}", "Profiles\ProfileController@getProfile")->name("profile");

// Jobs
Route::get("job-board", "Jobs\JobBoardController@getJobBoard")->name("jobs");

// Create jobs
Route::get("job-board/job-toevoegen", "Jobs\JobBoardController@getCreateJob")->name("jobs.create");
Route::post("job-board/job-toevoegen", "Jobs\JobBoardController@postCreateJob")->name("jobs.create.post");

// View job
Route::get("job-board/{slug}", "Jobs\JobBoardController@getJob")->name("jobs.view");

// Update job
Route::get("job-board/{slug}/aanpassen", "Jobs\JobBoardController@getEditJob")->name("jobs.edit");
Route::post("job-board/{slug}/aanpassen", "Jobs\JobBoardController@postEditJob")->name("jobs.edit.post");

// Delete job
Route::get("job-board/{slug}/verwijderen", "Jobs\JobBoardController@getDeleteJob")->name("jobs.delete");
Route::post("job-board/{slug}/verwijderen", "Jobs\JobBoardController@postDeleteJob")->name("jobs.delete.post");

// Api endpoints
Route::group(["prefix" => "api"], function() {

    // Job resources
    Route::group(["prefix" => "job-resources"], function() {
        Route::post("create", "Api\JobResourceController@postCreateResource")->name("api.jobs.resources.create.post");
        Route::post("update", "Api\JobResourceController@postUpdateResource")->name("api.jobs.resources.update.post");
        Route::post("delete", "Api\JobResourceController@postDeleteResource")->name("api.jobs.resources.delete.post");
    });

    // Comments
    Route::group(["prefix" => "comments"], function() {
        Route::post("create", "Api\CommentController@postCreateComment")->name("api.comments.create.post");
        Route::post("update", "Api\CommentController@postUpdateComment")->name("api.comments.update.post");
        Route::post("delete", "Api\CommentController@postDeleteComment")->name("api.comments.delete.post");
    });

    // Team member applications
    Route::group(["prefix" => "team-member-applications"], function() {
        Route::post("create", "Api\TeamMemberApplicationController@postCreateApplication")->name("api.team-member-applications.create.post");
        Route::post("update", "Api\TeamMemberApplicationController@postUpdateApplication")->name("api.team-member-applications.update.post");
        Route::post("delete", "Api\TeamMemberApplicationController@postDeleteApplication")->name("api.team-member-applications.delete.post");
        Route::post("accept", "Api\TeamMemberApplicationController@postAcceptApplication")->name("api.team-member-applications.accept.post");
        Route::post("deny", "Api\TeamMemberApplicationController@postDenyApplication")->name("api.team-member-applications.deny.post");
    });

    // Team roles
    Route::group(["prefix" => "team-roles"], function() {
        Route::post("unassign", "Api\TeamRoleController@postUnassign")->name("api.team-roles.unassign");
    });
    
});
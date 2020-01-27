<?php

namespace App\Providers;

use Auth;

use App\Services\Utilities\DateService;
use App\Services\Utilities\UploadService;

use App\Services\ModelServices\UserService;
use App\Services\ModelServices\MinistryService;
use App\Services\ModelServices\OrganizationService;
use App\Services\ModelServices\DepartmentService;
use App\Services\ModelServices\JobTitleService;
use App\Services\ModelServices\AssignmentService;
use App\Services\ModelServices\JobStatusService;
use App\Services\ModelServices\JobService;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeViews();
    }

    private function composeViews()
    {
        View::composer("layouts.app", function($view) {
            if (Auth::check()) {
                $view->with("user", Auth::user());
            }
        });
    }

    private function registerServices() 
    {
        $this->app->singleton("users", function() {
            return new UserService;
        });

        $this->app->singleton("ministries", function() {
            return new MinistryService;
        });

        $this->app->singleton("organizations", function() {
            return new OrganizationService;
        });

        $this->app->singleton("departments", function() {
            return new DepartmentService;
        });

        $this->app->singleton("job-titles", function() {
            return new JobTitleService;
        });

        $this->app->singleton("assignments", function() {
            return new AssignmentService;
        });

        $this->app->singleton("job-statuses", function() {
            return new JobStatusService;
        });

        $this->app->singleton("jobs", function() {
            return new JobService;
        });

        //
        // Utilities
        //

        $this->app->singleton("dates", function() {
            return new DateService;
        });

        $this->app->singleton("uploader", function() {
            return new UploadService;
        });
    }
}

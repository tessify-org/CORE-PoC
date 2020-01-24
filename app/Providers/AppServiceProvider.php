<?php

namespace App\Providers;

use App\Services\ModelServices\UserService;
use App\Services\ModelServices\MinistryService;
use App\Services\ModelServices\OrganizationService;
use App\Services\ModelServices\DepartmentService;
use App\Services\ModelServices\JobTitleService;
use App\Services\ModelServices\AssignmentService;

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
        // todo when relevant
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
    }
}

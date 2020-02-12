<?php

namespace App\Providers;

use Auth;

use App\Services\Utilities\DateService;
use App\Services\Utilities\UploadService;

use App\Services\ModelServices\UserService;
use App\Services\ModelServices\TaskService;
use App\Services\ModelServices\SkillService;
use App\Services\ModelServices\ProjectService;
use App\Services\ModelServices\CommentService;
use App\Services\ModelServices\TeamRoleService;
use App\Services\ModelServices\TaskStatusService;
use App\Services\ModelServices\TeamMemberService;
use App\Services\ModelServices\WorkMethodService;
use App\Services\ModelServices\ProjectStatusService;
use App\Services\ModelServices\ProjectCategoryService;
use App\Services\ModelServices\ProjectResourceService;
use App\Services\ModelServices\TeamMemberApplicationService;

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
            $view->with("user", Auth::user());
        });
        
        View::composer("layouts.admin", function($view) {
            $view->with("user", Auth::user());
        });
    }

    private function registerServices() 
    {
        $this->app->singleton("users", function() {
            return new UserService;
        });
        
        $this->app->singleton("projects", function() {
            return new ProjectService;
        });

        $this->app->singleton("project-statuses", function() {
            return new ProjectStatusService;
        });

        $this->app->singleton("project-categories", function() {
            return new ProjectCategoryService;
        });

        $this->app->singleton("project-resources", function() {
            return new ProjectResourceService;
        });

        $this->app->singleton("work-methods", function() {
            return new WorkMethodService;
        });

        $this->app->singleton("tasks", function() {
            return new TaskService;
        });
        
        $this->app->singleton("task-statuses", function() {
            return new TaskStatusService;
        });
        
        $this->app->singleton("team-members", function() {
            return new TeamMemberService;
        });

        $this->app->singleton("team-member-applications", function() {
            return new TeamMemberApplicationService;
        });

        $this->app->singleton("team-roles", function() {
            return new TeamRoleService;
        });

        $this->app->singleton("skills", function() {
            return new SkillService;
        });

        $this->app->singleton("comments", function() {
            return new CommentService;
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

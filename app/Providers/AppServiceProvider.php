<?php

namespace App\Providers;

use Auth;

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
        
    }
}

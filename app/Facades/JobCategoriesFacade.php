<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class JobCategoriesFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "job-categories";
    }
}
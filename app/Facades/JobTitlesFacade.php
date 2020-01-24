<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class JobTitlesFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "job-titles";
    }
}
<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class JobResourcesFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "job-resources";
    }
}
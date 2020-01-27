<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class JobStatusesFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "job-statuses";
    }
}
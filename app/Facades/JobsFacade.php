<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class JobsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "jobs";
    }
}
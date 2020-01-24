<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class DepartmentsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "departments";
    }
}
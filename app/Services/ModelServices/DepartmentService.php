<?php

namespace App\Services\ModelServices;

use App\Models\Department;
use App\Traits\ModelServiceGetters;
use App\Contracts\ModelServiceContract;

class DepartmentService implements ModelServiceContract
{
    use ModelServiceGetters;

    private $model;
    private $records;
    private $preloadedRecords;
    
    public function __construct()
    {
        $this->model = "App\Models\Department";
    }
    
    public function preload($instance)
    {
        return $instance;
    }
}
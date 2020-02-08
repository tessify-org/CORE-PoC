<?php

namespace App\Services\ModelServices;

use App\Models\Task;
use App\Traits\ModelServiceGetters;
use App\Contracts\ModelServiceContract;

class TaskService implements ModelServiceContract
{
    use ModelServiceGetters;

    private $model;
    private $records;
    private $preloadedRecords;
    
    public function __construct()
    {
        $this->model = "App\Models\Task";
    }
    
    public function preload($instance)
    {
        return $instance;
    }
}
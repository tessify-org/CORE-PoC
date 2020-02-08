<?php

namespace App\Services\ModelServices;

use App\Models\TaskStatus;
use App\Traits\ModelServiceGetters;
use App\Contracts\ModelServiceContract;

class TaskStatusService implements ModelServiceContract
{
    use ModelServiceGetters;

    private $model;
    private $records;
    private $preloadedRecords;
    
    public function __construct()
    {
        $this->model = "App\Models\TaskStatus";
    }
    
    public function preload($instance)
    {
        return $instance;
    }
}
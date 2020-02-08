<?php

namespace App\Services\ModelServices;

use App\Models\Ministry;
use App\Traits\ModelServiceGetters;
use App\Contracts\ModelServiceContract;

class MinistryService implements ModelServiceContract
{
    use ModelServiceGetters;

    private $model;
    private $records;
    private $preloadedRecords;
    
    public function __construct()
    {
        $this->model = "App\Models\Ministry";
    }
    
    public function preload($instance)
    {
        return $instance;
    }
}
<?php

namespace App\Services\ModelServices;

use App\Models\JobTitle;
use App\Traits\ModelServiceGetters;
use App\Contracts\ModelServiceContract;

class JobTitleService implements ModelServiceContract
{
    use ModelServiceGetters;

    private $model;
    private $records;
    private $preloadedRecords;
    
    public function __construct()
    {
        $this->model = "App\Models\JobTitle";
    }
    
    public function preload($instance)
    {
        return $instance;
    }
}
<?php

namespace App\Services\ModelServices;

use App\Models\Organization;
use App\Traits\ModelServiceGetters;
use App\Contracts\ModelServiceContract;

class OrganizationService implements ModelServiceContract
{
    use ModelServiceGetters;

    private $model;
    private $records;
    private $preloadedRecords;
    
    public function __construct()
    {
        $this->model = "App\Models\Organization";
    }
    
    public function preload($instance)
    {
        return $instance;
    }
}
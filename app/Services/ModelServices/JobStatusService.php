<?php

namespace App\Services\ModelServices;

use App\Models\Job;
use App\Models\JobStatus;
use App\Traits\ModelServiceGetters;
use App\Contracts\ModelServiceContract;

class JobStatusService implements ModelServiceContract
{
    use ModelServiceGetters;

    private $model;
    private $records;
    private $preloadedRecords;
    
    public function __construct()
    {
        $this->model = "App\Models\JobStatus";
    }
    
    public function preload($instance)
    {
        return $instance;
    }

    public function findForJob(Job $job)
    {
        foreach ($this->getAll() as $status)
        {
            if ($status->id == $job->job_status_id)
            {
                return $status;
            }
        }

        return false;
    }
}
<?php

namespace App\Services\ModelServices;

use JobTitles;
use Ministries;
use Departments;
use Organizations;

use App\Models\User;
use App\Models\Assignment;
use App\Traits\ModelServiceGetters;
use App\Contracts\ModelServiceContract;

class AssignmentService implements ModelServiceContract
{
    use ModelServiceGetters;

    private $model;
    private $records;
    private $preloadedRecords;
    
    public function __construct()
    {
        $this->model = "App\Models\Assignment";
    }
    
    public function preload($instance)
    {
        $instance->ministry = Ministries::find($instance->ministry_id);
        $instance->organization = Organizations::find($instance->organization_id);
        $instance->department = Departments::find($instance->department_id);
        $instance->job_title = JobTitles::find($instance->job_title_id);

        return $instance;
    }
    
    public function getAllForUser(User $user)
    {
        $out = [];

        foreach ($this->getAllPreloaded() as $assignment)
        {
            if ($assignment->user_id == $user->id)
            {
                $out[] = $assignment;
            }
        }

        return $out;
    }

    public function getCurrentForUser(User $user)
    {
        foreach ($this->getAllForUser($user) as $assignment)
        {
            if (is_null($assignment->stopped_at))
            {
                return $assignment;
            }
        }
        
        return false;
    }

    public function getPreviousForUser(User $user)
    {
        $out = [];

        foreach ($this->getAllForUser($user) as $assignment)
        {
            if (!is_null($assignment->stopped_at))
            {
                $out[] = $assignment;
            }
        }

        return $out;
    }
}
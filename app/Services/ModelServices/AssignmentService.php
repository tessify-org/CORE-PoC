<?php

namespace App\Services\ModelServices;

use JobTitles;
use Ministries;
use Departments;
use Organizations;

use App\Models\User;
use App\Models\Assignment;

class AssignmentService
{
    private $assignments;
    private $preloadedAssignments;
    
    public function getAll()
    {
        if (is_null($this->assignments))
        {
            $this->assignments = Assignment::all();
        }

        return $this->assignments;
    }

    public function getAllPreloaded()
    {
        if (is_null($this->preloadedAssignments))
        {
            $out = [];

            foreach ($this->getAll() as $assignment)
            {
                $out[] = $this->preload($assignment);
            }

            $this->preloadedAssignments = collect($out);
        }

        return $this->preloadedAssignments;
    }


    public function find($id)
    {
        foreach ($this->getAll() as $assignment)
        {
            if ($assignment->id == $id)
            {
                return $assignment;
            }
        }

        return false;
    }

    public function findPreloaded($id)
    {
        foreach ($this->getAllPreloaded() as $assignment)
        {
            if ($assignment->id == $id)
            {
                return $assignment;
            }
        }

        return false;
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

    private function preload(Assignment $assignment)
    {
        $assignment->ministry = Ministries::find($assignment->ministry_id);
        $assignment->organization = Organizations::find($assignment->organization_id);
        $assignment->department = Departments::find($assignment->department_id);
        $assignment->job_title = JobTitles::find($assignment->job_title_id);

        return $assignment;
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
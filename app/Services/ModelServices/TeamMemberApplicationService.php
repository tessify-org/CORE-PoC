<?php

namespace App\Services\ModelServices;

use App\Models\Job;
use App\Models\TeamMemberApplication;

class TeamMemberApplicationService
{
    private $applications;
    private $preloadedApplications;

    public function getAll()
    {
        if (is_null($this->applications))
        {
            $this->applications = TeamMemberApplication::all();
        }

        return $this->applications;
    }

    public function getAllPreloaded()
    {
        if (is_null($this->preloadedApplications))
        {
            $out = [];

            foreach ($this->getAll() as $application)
            {
                $out[] = $this->preload($application);
            }

            $this->preloadedApplications = collect($out);
        }

        return $this->preloadedApplications;
    }

    public function find($id)
    {
        foreach ($this->getAll() as $application)
        {
            if ($application->id == $id)
            {
                return $application;
            }
        }

        return false;
    }

    public function findPreloaded($id)
    {
        foreach ($this->getAllPreloaded() as $application)
        {
            if ($application->id == $id)
            {
                return $application;
            }
        }

        return false;
    }

    private function preload(TeamMemberApplication $application)
    {

        return $application;
    }

    public function getAllForJob(Job $job)
    {
        $out = [];

        foreach ($this->getAll() as $application)
        {
            if ($application->job_id == $job->id)
            {
                $out[] = $application;
            }
        }

        return $out;
    }
}
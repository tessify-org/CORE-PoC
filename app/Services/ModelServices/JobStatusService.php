<?php

namespace App\Services\ModelServices;

use App\Models\Job;
use App\Models\JobStatus;

class JobStatusService
{
    private $statuses;

    public function getAll()
    {
        if (is_null($this->statuses))
        {
            $this->statuses = JobStatus::all();
        }

        return $this->statuses;
    }

    public function find($id)
    {
        foreach ($this->getAll() as $status)
        {
            if ($status->id == $id)
            {
                return $status;
            }
        }

        return false;
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
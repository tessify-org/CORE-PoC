<?php

namespace App\Services\ModelServices;

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
}
<?php

namespace App\Services\ModelServices;

use App\Models\TaskStatus;

class TaskStatusService
{
    private $statuses;

    public function getAll()
    {
        if (is_null($this->statuses))
        {
            $this->statuses = TaskStatus::all();
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
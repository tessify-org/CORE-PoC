<?php

namespace App\Services\ModelServices;

use App\Models\Task;

class TaskService
{
    private $tasks;

    public function getAll()
    {
        if (is_null($this->tasks))
        {
            $this->tasks = Task::all();
        }

        return $this->tasks;
    }

    public function find($id)
    {
        foreach ($this->getAll() as $task)
        {
            if ($task->id == $id)
            {
                return $task;
            }
        }

        return false;
    }
}
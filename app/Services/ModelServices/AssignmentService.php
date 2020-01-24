<?php

namespace App\Services\ModelServices;

class AssignmentService
{
    private $assignments;
    
    public function getAll()
    {
        if (is_null($this->assignments))
        {
            $this->assignments = Assignment::all();
        }

        return $this->assignments;
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
}
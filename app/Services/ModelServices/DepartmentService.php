<?php

namespace App\Services\ModelServices;

use App\Models\Department;

class DepartmentService
{
    private $departments;

    public function getAll()
    {
        if (is_null($this->departments))
        {
            $this->departments = Department::all();
        }

        return $this->departments;
    }

    public function find($id)
    {
        foreach ($this->getAll() as $department)
        {
            if ($department->id == $id)
            {
                return $department;
            }
        }

        return false;
    }
}
<?php

namespace App\Services\ModelServices;

use App\Models\Ministry;

class MinistryService
{
    private $ministries;

    public function getAll()
    {
        if (is_null($this->ministries))
        {
            $this->ministries = Ministry::all();
        }

        return $this->ministries;
    }

    public function find($id)
    {
        foreach ($this->getAll() as $ministry)
        {
            if ($ministry->id == $id)
            {
                return $ministry;
            }
        }

        return false;
    }
}
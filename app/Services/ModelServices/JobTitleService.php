<?php

namespace App\Services\ModelServices;

use App\Models\JobTitle;

class JobTitleService
{
    private $titles;

    public function getAll()
    {
        if (is_null($this->titles))
        {
            $this->titles = JobTitle::all();
        }

        return $this->titles;
    }

    public function find($id)
    {
        foreach ($this->getAll() as $title)
        {
            if ($title->id == $id)
            {
                return $title;
            }
        }

        return false;
    }
}
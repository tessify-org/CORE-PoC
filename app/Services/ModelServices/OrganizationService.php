<?php

namespace App\Services\ModelServices;

use App\Models\Organization;

class OrganizationService
{
    private $organizations;

    public function getAll()
    {
        if (is_null($this->organizations))
        {
            $this->organizations = Organization::all();
        }

        return $this->organizations;
    }

    public function find($id)
    {
        foreach ($this->getAll() as $organization)
        {
            if ($organization->id == $id)
            {
                return $organization;
            }
        }

        return false;
    }
}
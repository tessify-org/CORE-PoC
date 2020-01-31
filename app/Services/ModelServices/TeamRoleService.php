<?php

namespace App\Services\ModelServices;

use Skills;
use App\Models\Job;
use App\Models\TeamRole;

class TeamRoleService
{
    private $roles;
    private $preloadedRoles;

    public function getAll()
    {
        if (is_null($this->roles))
        {
            $this->roles = TeamRole::all();
        }

        return $this->roles;
    }

    public function getAllPreloaded()
    {
        if (is_null($this->preloadedRoles))
        {
            $out = [];

            foreach ($this->getAll() as $role)
            {
                $out[] = $this->preload($role);
            }

            $this->preloadedRoles = collect($out);
        }

        return $this->preloadedRoles;
    }

    public function getAllPreloadedForJob(Job $job)
    {
        $out = [];

        foreach ($this->getAllPreloaded() as $role)
        {
            if ($role->job_id == $job->id)
            {
                $out[] = $role;
            }
        }

        return collect($out);
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

    public function findPreloaded($id)
    {
        foreach ($this->getAllPreloaded() as $role)
        {
            if ($role->id == $id)
            {
                return $role;
            }
        }

        return false;
    }

    private function preload(TeamRole $role)
    {
        $role->skills = Skills::getAllForTeamRole($role);
        
        return $role;
    }
}
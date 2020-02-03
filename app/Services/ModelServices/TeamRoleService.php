<?php

namespace App\Services\ModelServices;

use DB;
use Skills;
use TeamMembers;
use App\Models\Job;
use App\Models\TeamRole;

class TeamRoleService
{
    private $roles;
    private $preloadedRoles;
    private $teamMemberPivots;

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

        return $out;
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

    public function getTeamMemberPivots()
    {
        if (is_null($this->teamMemberPivots))
        {
            $this->teamMemberPivots = DB::table("team_member_team_role")->get();
        }

        return $this->teamMemberPivots;
    }

    public function getTeamMemberForTeamRole(TeamRole $role)
    {
        $teamMember = null;

        foreach ($this->getTeamMemberPivots() as $pivot)
        {
            if ($pivot->team_role_id == $role->id)
            {
                $teamMember = TeamMembers::findPreloaded($pivot->team_member_id);
            }
        }

        return $teamMember;
    }

    private function preload(TeamRole $role)
    {
        // Load role's assigned team member
        $role->team_member = $this->getTeamMemberForTeamRole($role);

        // Load role's required skills
        $role->skills = Skills::getAllForTeamRole($role);
        
        return $role;
    }
}
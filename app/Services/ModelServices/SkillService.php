<?php

namespace App\Services\ModelServices;

use DB;

use App\Models\Skill;
use App\Models\TeamRole;
use App\Traits\ModelServiceGetters;
use App\Contracts\ModelServiceContract;

class SkillService implements ModelServiceContract
{
    use ModelServiceGetters;

    private $model;
    private $records;
    private $preloadedRecords;

    private $skillUser;
    private $skillTeamRole;

    public function __construct()
    {
        $this->model = "App\Models\Skill";
    }
    
    public function preload($instance)
    {
        return $instance;
    }

    public function getSkillUserPivots()
    {
        if (is_null($this->skillUser))
        {
            $this->skillUser = DB::table("skill_user")->get();
        }

        return $this->skillUser;
    }

    public function getSkillTeamRolePivots()
    {
        if (is_null($this->skillTeamRole))
        {
            $this->skillTeamRole = DB::table("skill_team_role")->get();
        }

        return $this->skillTeamRole;
    }

    public function getAllForTeamRole(TeamRole $role)
    {
        $out = [];

        foreach ($this->getSkillTeamRolePivots() as $pivot)
        {
            if ($pivot->team_role_id == $role->id)
            {
                $skill = $this->find($pivot->skill_id);
                if ($skill)
                {
                    $out[] = $skill;
                }
            }
        }

        return $out;
    }

    public function findByName($name)
    {
        foreach ($this->getAll() as $skill)
        {
            if ($skill->name == $name)
            {
                return $skill;
            }
        }

        return false;
    }

    public function findOrCreateByName($name)
    {
        // Attempt to find the skill by it's name; if found return it
        $skill = $this->findByName($name);
        if ($skill) return $skill;

        // If we've reached this point we couldn't find the skill, so let's create one
        return $this->create(["name" => $name]);
    }

    public function create($data)
    {
        return Skill::create($data);
    }
}
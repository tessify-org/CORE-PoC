<?php

namespace App\Services\ModelServices;

use App\Models\TeamMember;

class TeamMemberService
{
    private $members;

    public function getAll()
    {
        if (is_null($this->members))
        {
            $this->members = TeamMember::all();
        }
        
        return $this->members;
    }

    public function find($id)
    {
        foreach ($this->getAll() as $member)
        {
            if ($member->id == $id)
            {
                return $member;
            }
        }

        return false;
    }
}
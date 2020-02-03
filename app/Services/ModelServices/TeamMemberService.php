<?php

namespace App\Services\ModelServices;

use Users;
use App\Models\TeamMember;

class TeamMemberService
{
    private $members;
    private $preloadedMembers;

    public function getAll()
    {
        if (is_null($this->members))
        {
            $this->members = TeamMember::all();
        }
        
        return $this->members;
    }

    public function getAllPreloaded()
    {
        if (is_null($this->preloadedMembers))
        {
            $out = [];

            foreach ($this->getAll() as $member)
            {
                $out[] = $this->preload($member);
            }

            $this->preloadedMembers = collect($out);
        }

        return $this->preloadedMembers;
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

    public function findPreloaded($id)
    {
        foreach ($this->getAllPreloaded() as $member)
        {
            if ($member->id == $id)
            {
                return $member;
            }
        }

        return false;
    }

    private function preload(TeamMember $member)
    {
        $member->user = Users::findPreloaded($member->user_id);

        return $member;
    }
}
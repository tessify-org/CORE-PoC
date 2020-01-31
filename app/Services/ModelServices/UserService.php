<?php

namespace App\Services\ModelServices;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Assignment;
use App\Http\Requests\Profiles\UpdateProfileRequest;

class UserService
{
    private $users;
    private $preloadedUsers;

    public function getAll()
    {
        if (is_null($this->users))
        {
            $this->users = User::all();
        }

        return $this->users;
    }

    public function getAllPreloaded()
    {
        if (is_null($this->preloadedUsers))
        {
            $out = [];

            foreach ($this->getAll() as $user)
            {
                $out[] = $this->preload($user);
            }

            $this->preloadedUsers = collect($out);
        }

        return $this->preloadedUsers;
    }

    public function find($id)
    {
        foreach ($this->getAll() as $user)
        {
            if ($user->id == $id)
            {
                return $user;
            }
        }

        return false;
    }

    public function findPreloaded($id)
    {
        foreach ($this->getAllPreloaded() as $user)
        {
            if ($user->id == $id)
            {
                return $user;
            }
        }

        return false;
    }

    private function preload(User $user)
    {
        $user->profile_href = route("profile", $user->slug);
        
        $user->formatted_name = $user->formattedName;
        $user->combined_name = $user->combined_name;

        return $user;
    }

    public function updateAssignments(User $user, UpdateProfileRequest $request)
    {
        $user->assignments()->delete();
        
        $assignments = json_decode($request->assignments);
        if (is_array($assignments) && count($assignments) > 0)
        {
            $now = Carbon::now();

            $i = 0;
            foreach ($assignments as $data)
            {
                Assignment::create([
                    "user_id" => $user->id,
                    "ministry_id" => $data->ministry_id,
                    "organization_id" => $data->organization_id,
                    "department_id" => $data->department_id,
                    "job_title_id" => $data->job_title_id,
                    "order" => $i,
                    "started_at" => $now->format("Y-m-d"),
                ]);

                $i++;
            }
        }
    }
}
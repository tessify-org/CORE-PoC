<?php

namespace App\Services\ModelServices;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Assignment;
use App\Http\Requests\Profiles\UpdateProfileRequest;

class UserService
{
    private $users;

    public function getAll()
    {
        if (is_null($this->users))
        {
            $this->users = User::all();
        }

        return $this->users;
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
<?php

namespace App\Services\ModelServices;

use Auth;
use Assignments;
use Carbon\Carbon;

use App\Models\Job;
use App\Models\User;
use App\Models\Assignment;
use App\Traits\ModelServiceGetters;
use App\Contracts\ModelServiceContract;
use App\Http\Requests\Profiles\UpdateProfileRequest;


class UserService implements ModelServiceContract
{
    use ModelServiceGetters;

    private $model;
    private $records;
    private $preloadedRecords;

    public function __construct()
    {
        $this->model = "App\Models\User";
    }

    public function current()
    {
        $user = Auth::user();
        if ($user)
        {
            return $this->findPreloaded($user->id);
        }

        return false;
    }

    public function preload($instance)
    {
        // Add link to the user's profile page
        $instance->profile_href = route("profile", $instance->slug);
        
        // Manually load the dynamic attributes
        $instance->formatted_name = $instance->formattedName;
        $instance->combined_name = $instance->combined_name;

        // Load current & previous assignments
        $instance->current_assignment = Assignments::getCurrentForUser($instance);
        $instance->previous_assignments = Assignments::getPreviousForUser($instance);

        // TODO: load relationships.. not necessary yet

        // Return the upgraded user
        return $instance;
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

    public function findAuthorForJob(Job $job)
    {
        foreach ($this->getAllPreloaded() as $user)
        {
            if ($user->id == $job->author_id)
            {
                return $user;
            }
        }

        return false;
    }

    public function saveAvatar($id, $url)
    {
        $user = User::find($id);
        $user->avatar_url = $url;
        $user->save();
        return $user;
    }
}
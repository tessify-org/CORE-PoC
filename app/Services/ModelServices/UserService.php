<?php

namespace App\Services\ModelServices;

use Auth;
use Carbon\Carbon;

use App\Models\Job;
use App\Models\User;
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

        // TODO: load relationships.. not necessary yet

        // Return the upgraded user
        return $instance;
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
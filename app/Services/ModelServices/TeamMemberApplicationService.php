<?php

namespace App\Services\ModelServices;

use Auth;
use Users;
use TeamRoles;

use App\Models\Job;
use App\Models\TeamMemberApplication;
use App\Traits\ModelServiceGetters;
use App\Contracts\ModelServiceContract;
use App\Http\Requests\Api\Jobs\TeamMemberApplications\CreateTeamMemberApplicationRequest;
use App\Http\Requests\Api\Jobs\TeamMemberApplications\UpdateTeamMemberApplicationRequest;
use App\Http\Requests\Api\Jobs\TeamMemberApplications\AcceptTeamMemberApplicationRequest;
use App\Http\Requests\Api\Jobs\TeamMemberApplications\DenyTeamMemberApplicationRequest;

class TeamMemberApplicationService implements ModelServiceContract
{
    use ModelServiceGetters;

    private $model;
    private $records;
    private $preloadedRecords;
    
    public function __construct()
    {
        $this->model = "App\Models\Task";
    }

    public function preload($instance)
    {
        $instance->user = Users::findPreloaded($instance->user_id);
        $instance->team_role = TeamRoles::find($instance->team_role_id);
        $instance->formatted_created_at = $instance->created_at->format("d-m-Y H:m:s");

        return $instance;
    }

    public function getAllForJob(Job $job)
    {
        $out = [];

        foreach ($this->getAllPreloaded() as $application)
        {
            if ($application->job_id == $job->id)
            {
                $out[] = $application;
            }
        }

        return $out;
    }

    public function deny(DenyTeamMemberApplicationRequest $request)
    {
        $application = $this->find($request->team_member_application_id);
        $application->processed = true;
        $application->accepted = false;
        $application->save();

        return $application;
    }

    public function accept(AcceptTeamMemberApplicationRequest $request)
    {
        $application = $this->find($request->team_member_application_id);
        $application->processed = true;
        $application->accepted = true;
        $application->save();

        return $application;
    }

    public function createFromRequest(CreateTeamMemberApplicationRequest $request)
    {
        $application = TeamMemberApplication::create([
            "job_id" => $request->job_id,
            "user_id" => Auth::user()->id,
            "team_role_id" => $request->team_role_id,
            "motivation" => $request->motivation,
        ]);

        return $this->preload($application);
    }

    public function updateFromRequest(UpdateTeamMemberApplicationRequest $request)
    {
        $application = $this->find($request->team_member_application_id);
        $application->motivation = $request->motivation;
        $application->save();

        return $this->preload($application);
    }
}
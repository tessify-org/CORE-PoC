<?php

namespace App\Services\ModelServices;

use Auth;
use Users;
use TeamRoles;
use App\Models\Job;
use App\Models\TeamMemberApplication;
use App\Http\Requests\Api\Jobs\TeamMemberApplications\CreateTeamMemberApplicationRequest;
use App\Http\Requests\Api\Jobs\TeamMemberApplications\UpdateTeamMemberApplicationRequest;
use App\Http\Requests\Api\Jobs\TeamMemberApplications\AcceptTeamMemberApplicationRequest;
use App\Http\Requests\Api\Jobs\TeamMemberApplications\DenyTeamMemberApplicationRequest;

class TeamMemberApplicationService
{
    private $applications;
    private $preloadedApplications;

    public function getAll()
    {
        if (is_null($this->applications))
        {
            $this->applications = TeamMemberApplication::all();
        }

        return $this->applications;
    }

    public function getAllPreloaded()
    {
        if (is_null($this->preloadedApplications))
        {
            $out = [];

            foreach ($this->getAll() as $application)
            {
                $out[] = $this->preload($application);
            }

            $this->preloadedApplications = collect($out);
        }

        return $this->preloadedApplications;
    }

    public function find($id)
    {
        foreach ($this->getAll() as $application)
        {
            if ($application->id == $id)
            {
                return $application;
            }
        }

        return false;
    }

    public function findPreloaded($id)
    {
        foreach ($this->getAllPreloaded() as $application)
        {
            if ($application->id == $id)
            {
                return $application;
            }
        }

        return false;
    }

    private function preload(TeamMemberApplication $application)
    {
        $application->user = Users::findPreloaded($application->user_id);
        $application->team_role = TeamRoles::find($application->team_role_id);
        $application->formatted_created_at = $application->created_at->format("d-m-Y H:m:s");
        return $application;
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
<?php

namespace App\Http\Controllers\Jobs;

use Auth;
use Jobs;
use Users;
use Skills;
use Comments;
use WorkMethods;
use JobStatuses;
use JobResources;
use JobCategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Jobs\CreateJobRequest;
use App\Http\Requests\Jobs\UpdateJobRequest;
use App\Http\Requests\Jobs\DeleteJobRequest;

class JobBoardController extends Controller
{
    public function getJobBoard()
    {
        return view("pages.jobs.overview", [
            "jobs" => Jobs::getAllPreloaded(),
        ]);
    }

    public function getJob($slug)
    {
        $job = Jobs::findPreloadedBySlug($slug);
        if (!$job)
        {
            flash("Job kon niet worden gevonden")->error();
            return redirect()->route("jobs");
        }

        return view("pages.jobs.view", [
            "job" => $job,
            "user" => Users::current(),
            "comments" => Comments::getAllPreloadedForJob($job),
        ]);
    }

    public function getCreateJob()
    {
        return view("pages.jobs.create", [
            "statuses" => JobStatuses::getAll(),
            "categories" => JobCategories::getAll(),
            "workMethods" => WorkMethods::getAll(),
            "skills" => Skills::getAll(),
            "oldInput" => collect([
                "job_status_id" => old("job_status_id"),
                "job_category_id" => old("job_category_id"),
                "work_method_id" => old("work_method_id"),
                "title" => old("title"),
                "slogan" => old("slogan"),
                "problem" => old("problem"),
                "description" => old("description"),
                "starts_at" => old("starts_at"),
                "ends_at" => old("ends_at"),
                "resources" => old("resources"),
                "team_roles" => old("team_roles"),
            ])
        ]);
    }

    public function postCreateJob(CreateJobRequest $request)
    {
        $job = Jobs::createFromRequest($request);

        flash("Job is toegevoegd!")->success();
        return redirect()->route("jobs.view", $job->slug);
    }

    public function getEditJob($slug)
    {
        $job = Jobs::findPreloadedBySlug($slug);
        if (!$job)
        {   
            flash("Job kon niet worden gevonden")->error();
            return redirect()->route("jobs");
        }

        return view("pages.jobs.edit", [
            "job" => $job,
            "statuses" => JobStatuses::getAll(),
            "categories" => JobCategories::getAll(),
            "workMethods" => WorkMethods::getAll(),
            "skills" => Skills::getAll(),
            "oldInput" => collect([
                "job_status_id" => old("job_status_id"),
                "job_category_id" => old("job_category_id"),
                "work_method_id" => old("work_method_id"),
                "title" => old("title"),
                "slogan" => old("slogan"),
                "problem" => old("problem"),
                "description" => old("description"),
                "starts_at" => old("starts_at"),
                "ends_at" => old("ends_at"),
                "resources" => old("resources"),
                "team_roles" => old("team_roles"),
            ])
        ]);
    }

    public function postEditJob(UpdateJobRequest $request, $slug)
    {
        $job = Jobs::findBySlug($slug);
        if (!$job)
        {   
            flash("Job kon niet worden gevonden")->error();
            return redirect()->route("jobs");
        }

        $job = Jobs::updateFromRequest($job, $request);

        flash("Wijzigingen zijn opgeslagen!")->success();
        return redirect()->route("jobs.view", $job->slug);
    }

    public function getDeleteJob($slug)
    {
        $job = Jobs::findBySlug($slug);
        if (!$job)
        {   
            flash("Job kon niet worden gevonden")->error();
            return redirect()->route("jobs");
        }

        return view("pages.jobs.delete", [
            "job" => $job,
        ]);
    }

    public function postDeleteJob(DeleteJobRequest $request, $slug)
    {
        $job = Jobs::findBySlug($slug);
        if (!$job)
        {   
            flash("Job kon niet worden gevonden")->error();
            return redirect()->route("jobs");
        }

        $job->delete();

        flash("Job is met success verwijderd.")->success();
        return redirect()->route("jobs");
    }
}
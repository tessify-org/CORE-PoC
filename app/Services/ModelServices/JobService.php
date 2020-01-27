<?php

namespace App\Services\ModelServices;

use Auth;
use Dates;
use Uploader;
use App\Models\Job;
use App\Http\Requests\Jobs\CreateJobRequest;
use App\Http\Requests\Jobs\UpdateJobRequest;

class JobService
{
    private $jobs;
    private $preloadedJobs;

    public function getAll()
    {
        if (is_null($this->jobs))
        {
            $this->jobs = Job::all();
        }

        return $this->jobs;
    }

    public function getAllPreloaded()
    {
        if (is_null($this->preloadedJobs))
        {
            $out = [];

            foreach ($this->getAll() as $job)
            {
                $out[] = $this->preload($job);
            }

            return collect($out);
        }

        return $this->preloadedJobs;
    }

    public function find($id)
    {
        foreach ($this->getAll() as $job)
        {
            if ($job->id == $id)
            {
                return $job;
            }
        }

        return false;
    }

    public function findBySlug($slug)
    {
        foreach ($this->getAll() as $job)
        {
            if ($job->slug == $slug)
            {
                return $job;
            }
        }

        return false;
    }
    
    public function findPreloaded($id)
    {
        foreach ($this->getAllPreloaded() as $job)
        {
            if ($job->id == $id)
            {
                return $job;
            }
        }

        return false;
    }

    public function findPreloadedBySlug($slug)
    {
        foreach ($this->getAllPreloaded() as $job)
        {
            if ($job->slug == $slug)
            {
                return $job;
            }
        }

        return false;
    }

    private function preload(Job $job)
    {
        $job->header_image_url = asset($job->header_image_url);

        return $job;
    }

    public function createFromRequest(CreateJobRequest $request)
    {
        $starts_at = Dates::parse($request->starts_at, "/");
        $ends_at = Dates::parse($request->ends_at, "/");

        $data = [
            "author_id" => Auth::user()->id,
            "job_status_id" => $request->job_status_id,
            "title" => $request->title,
            "slogan" => $request->slogan,
            "problem" => $request->problem,
            "description" => $request->description,
            "starts_at" => $starts_at->format("Y-m-d"),
            "ends_at" => $ends_at->format("Y-m-d"),
        ];

        if ($request->hasFile("header_image"))
        {
            $data["header_image_url"] = Uploader::upload($request->file("header_image"), "images/jobs/header");
        }

        $job = Job::create($data);

        return $job;
    }

    public function updateFromRequest(Job $job, UpdateJobRequest $request)
    {
        $starts_at = Dates::parse($request->starts_at, "/");
        $ends_at = Dates::parse($request->ends_at, "/");

        $job->title = $request->title;
        $job->slogan = $request->slogan;
        $job->problem = $request->problem;
        $job->description = $request->description;
        $job->starts_at = $starts_at->format("Y-m-d");
        $job->ends_at = $ends_at->format("Y-m-d");

        if ($request->hasFile("header_image"))
        {
            $job->header_image_url = Uploader::upload($request->file("header_image"), "images/jobs/header");
        }

        $job->save();

        return $job;
    }
}
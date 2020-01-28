<?php

namespace App\Services\ModelServices;

use Auth;
use Uploader;
use App\Models\Job;
use App\Models\JobResource;
use App\Http\Requests\Api\Jobs\Resources\CreateJobResourceRequest;
use App\Http\Requests\Api\Jobs\Resources\UpdateJobResourceRequest;

class JobResourceService
{
    private $resources;
    private $preloadedResources;

    public function getAll()
    {
        if (is_null($this->resources))
        {
            $this->resources = JobResource::all();
        }

        return $this->resources;
    }

    public function getAllPreloaded()
    {
        if (is_null($this->preloadedResources))
        {
            $out = [];

            foreach ($this->getAll() as $resource)
            {
                $out[] = $this->preload($resource);
            }

            $this->preloadedResources = collect($out);
        }

        return $this->preloadedResources;
    }

    public function getAllPreloadedForJob(Job $job)
    {
        $out = [];

        foreach ($this->getAllPreloaded() as $resource)
        {
            if ($resource->job_id == $job->id)
            {
                $out[] = $resource;
            }
        }

        return collect($out);
    }
    
    public function find($id)
    {
        foreach ($this->getAll() as $resource)
        {
            if ($resource->id == $id)
            {
                return $resource;
            }
        }

        return false;
    }

    public function findPreloaded($id)
    {
        foreach ($this->getAllPreloaded() as $resource)
        {
            if ($resource->id == $id)
            {
                return $resource;
            }
        }

        return false;
    }

    public function preload(JobResource $resource)
    {
        // Convert file url from relative to absolute
        $resource->file_url = asset($resource->file_url);
        
        return $resource;
    }

    public function createFromRequest(CreateJobResourceRequest $request)
    {
        $user = Auth::user();

        $resource = JobResource::create([
            "job_id" => $request->job_id,
            "user_id" => $user->id,
            "title" => $request->title,
            "description" => $request->description,
            "file_url" => Uploader::upload($request->file("file"), "files/job_resources"),
            "file_size" => $request->file("file")->getSize(),
        ]);

        return $resource;
    }
    
    public function updateFromRequest(UpdateJobResourceRequest $request)
    {
        $resource = $this->find($request->job_resource_id);
        if ($resource)
        {
            $resource->title = $request->title;
            $resource->description = $request->description;
    
            if ($request->hasFile("file"))
            {
                $resource->file_url = Uploader::upload($request->file("file"), "files/job_resources");
                $resource->file_size = $request->file("file")->getSize();
            }
            
            $resource->save();

            return $resource;
        }

        return false;
    }
}
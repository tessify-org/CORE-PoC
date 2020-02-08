<?php

namespace App\Services\ModelServices;

use Auth;
use Uploader;

use App\Models\Job;
use App\Models\JobResource;
use App\Traits\ModelServiceGetters;
use App\Contracts\ModelServiceContract;
use App\Http\Requests\Api\Jobs\Resources\CreateJobResourceRequest;
use App\Http\Requests\Api\Jobs\Resources\UpdateJobResourceRequest;

class JobResourceService implements ModelServiceContract
{
    use ModelServiceGetters;

    private $model;
    private $records;
    private $preloadedRecords;
    
    public function __construct()
    {
        $this->model = "App\Models\JobResource";
    }
    
    public function preload($instance)
    {
        // Convert file url from relative to absolute
        $instance->file_url = asset($instance->file_url);
        
        return $instance;
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

        return $out;
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
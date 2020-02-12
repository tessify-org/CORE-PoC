<?php

namespace App\Services\ModelServices;

use Auth;
use Uploader;

use App\Models\Project;
use App\Models\ProjectResource;
use App\Traits\ModelServiceGetters;
use App\Contracts\ModelServiceContract;
use App\Http\Requests\Api\Jobs\Resources\CreateProjectResourceRequest;
use App\Http\Requests\Api\Jobs\Resources\UpdateProjectResourceRequest;

class ProjectResourceService implements ModelServiceContract
{
    use ModelServiceGetters;

    private $model;
    private $records;
    private $preloadedRecords;
    
    public function __construct()
    {
        $this->model = "App\Models\ProjectResource";
    }
    
    public function preload($instance)
    {
        // Convert file url from relative to absolute
        $instance->file_url = asset($instance->file_url);
        
        return $instance;
    }

    public function getAllPreloadedForProject(Project $project)
    {
        $out = [];

        foreach ($this->getAllPreloaded() as $resource)
        {
            if ($resource->project_id == $project->id)
            {
                $out[] = $resource;
            }
        }

        return $out;
    }

    public function createFromRequest(CreateProjectResourceRequest $request)
    {
        $user = Auth::user();

        $resource = ProjectResource::create([
            "project_id" => $request->project_id,
            "user_id" => $user->id,
            "title" => $request->title,
            "description" => $request->description,
            "file_url" => Uploader::upload($request->file("file"), "files/job_resources"),
            "file_size" => $request->file("file")->getSize(),
        ]);

        return $resource;
    }
    
    public function updateFromRequest(UpdateProjectResourceRequest $request)
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
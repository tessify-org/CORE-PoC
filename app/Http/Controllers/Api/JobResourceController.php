<?php

namespace App\Http\Controllers\Api;

use JobResources;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Jobs\Resources\CreateJobResourceRequest;
use App\Http\Requests\Api\Jobs\Resources\UpdateJobResourceRequest;
use App\Http\Requests\Api\Jobs\Resources\DeleteJobResourceRequest;

class JobResourceController extends Controller
{
    public function postCreateResource(CreateJobResourceRequest $request)
    {
        $resource = JobResources::createFromRequest($request);
        if ($resource)
        {
            return response()->json([
                "status" => "success",
                "resource" => $resource,
            ]);
        }

        return response()->json([
            "status" => "error",
            "error" => "Resource kon niet worden geupload"
        ]);
    }

    public function postUpdateResource(UpdateJobResourceRequest $request)
    {
        $resource = JobResources::updateFromRequest($request);
        if ($resource)
        {
            return response()->json([
                "status" => "success",
                "resource" => $resource,
            ]);
        }

        return response()->json([
            "status" => "error",
            "error" => "Resource kon niet worden aangepast."
        ]);
    }

    public function postDeleteResource(DeleteJobResourceRequest $request)
    {   
        $resource = JobResources::find($request->job_resource_id);
        if ($resource)
        {
            $resource->delete();

            return response()->json(["status" => "success"]);
        }
        
        return response()->json([
            "status" => "error", 
            "error" => "Resource kon niet worden gevonden."
        ]);
    }
}
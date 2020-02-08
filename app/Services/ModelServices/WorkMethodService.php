<?php

namespace App\Services\ModelServices;

use App\Models\Job;
use App\Models\WorkMethod;
use App\Traits\ModelServiceGetters;
use App\Contracts\ModelServiceContract;
use App\Http\Requests\Jobs\WorkMethods\CreateWorkMethodRequest;
use App\Http\Requests\Jobs\WorkMethods\UpdateWorkMethodRequest;

class WorkMethodService implements ModelServiceContract
{
    use ModelServiceGetters;

    private $model;
    private $records;
    private $preloadedRecords;

    public function __construct()
    {
        $this->model = "App\Models\WorkMethod";
    }
    
    public function preload($instance)
    {
        return $instance;
    }

    public function findForJob(Job $job)
    {
        return $this->find($job->work_method_id);
    }

    public function createFromRequest(CreateWorkMethodRequest $request)
    {
        return WorkMethod::create([
            "name" => $request->name,
            "label" => $request->label,
            "description" => $request->description,
            "external_url" => $request->external_url,
        ]);
    }

    public function updateFromRequest(WorkMethod $workMethod, UpdateWorkMethodRequest $request)
    {
        $workMethod->name = $request->name;
        $workMethod->label = $request->label;
        $workMethod->description = $request->description;
        $workMethod->external_url = $request->external_url;
        $workMethod->save();

        return $workMethod;
    }
}
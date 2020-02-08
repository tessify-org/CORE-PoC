<?php

namespace App\Services\ModelServices;

use App\Models\Job;
use App\Models\JobCategory;
use App\Traits\ModelServiceGetters;
use App\Contracts\ModelServiceContract;
use App\Http\Requests\Jobs\Categories\CreateJobCategoryRequest;
use App\Http\Requests\Jobs\Categories\UpdateJobCategoryRequest;

class JobCategoryService implements ModelServiceContract
{
    use ModelServiceGetters;

    private $model;
    private $records;
    private $preloadedRecords;
    
    public function __construct()
    {
        $this->model = "App\Models\JobCategory";
    }

    public function preload($instance)
    {
        return $instance;
    }
    
    public function findForJob(Job $job)
    {
        return $this->find($job->job_category_id);
    }

    public function createFromRequest(CreateJobCategoryRequest $request)
    {
        return JobCategory::create([
            "name" => $request->name,
            "label" => $request->label,
        ]);
    }

    public function updateFromRequest(JobCategory $category, UpdateJobCategoryRequest $request)
    {
        $category->name = $request->name;
        $category->label = $request->label;
        $category->save();

        return $category;
    }
}
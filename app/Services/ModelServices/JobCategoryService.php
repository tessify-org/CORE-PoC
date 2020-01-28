<?php

namespace App\Services\ModelServices;

use App\Models\JobCategory;
use App\Http\Requests\Jobs\Categories\CreateJobCategoryRequest;
use App\Http\Requests\Jobs\Categories\UpdateJobCategoryRequest;

class JobCategoryService
{
    private $categories;

    public function getAll()
    {
        if (is_null($this->categories))
        {
            $this->categories = JobCategory::all();
        }

        return $this->categories;
    }

    public function find($id)
    {
        foreach ($this->getAll() as $category)
        {
            if ($category->id == $id)
            {
                return $category;
            }
        }

        return false;
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
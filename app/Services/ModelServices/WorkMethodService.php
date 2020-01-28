<?php

namespace App\Services\ModelServices;

use App\Models\WorkMethod;
use App\Http\Requests\Jobs\WorkMethods\CreateWorkMethodRequest;
use App\Http\Requests\Jobs\WorkMethods\UpdateWorkMethodRequest;

class WorkMethodService
{
    private $methods;

    public function getAll()
    {
        if (is_null($this->methods))
        {
            $this->methods = WorkMethod::all();
        }

        return $this->methods;
    }

    public function find($id)
    {
        foreach ($this->getAll() as $method)
        {
            if ($method->id == $id)
            {
                return $method;
            }
        }

        return false;
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
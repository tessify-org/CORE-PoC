<?php

namespace App\Services\ModelServices;

use Users;

use App\Models\TeamMember;
use App\Traits\ModelServiceGetters;
use App\Contracts\ModelServiceContract;

class TeamMemberService implements ModelServiceContract
{
    use ModelServiceGetters;

    private $model;
    private $records;
    private $preloadedRecords;
    
    public function __construct()
    {
        $this->model = "App\Models\TeamMember";
    }

    public function preload($instance)
    {
        $instance->user = Users::findPreloaded($instance->user_id);

        return $instance;
    }
}
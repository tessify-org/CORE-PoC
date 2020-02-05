<?php

namespace App\Http\Controllers\Api;

use TeamRoles;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Jobs\TeamRoles\UnassignTeamRoleRequest;

class TeamRoleController extends Controller
{
    public function postUnassign(UnassignTeamRoleRequest $request)
    {
        TeamRoles::unassignFromRequest($request);

        return response()->json(["status" => "success"]);
    }
}
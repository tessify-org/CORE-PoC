<?php

namespace App\Http\Controllers\Profiles;

use App\Models\User;
use App\Http\Controllers\Controller;

class MemberlistController extends Controller
{
    public function getMemberlist()
    {
        return view("pages.profiles.memberlist", [
            "users" => User::all(),
        ]);
    }
}
<?php

namespace App\Http\Controllers\Profiles;

use Users;
use Memberlist;
use App\Http\Controllers\Controller;

class MemberlistController extends Controller
{
    public function getMemberlist()
    {
        $users = Users::getAllPreloaded();
        return view("pages.profiles.memberlist", [
            "users" => $users,
        ]);
    }
}
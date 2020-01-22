<?php

namespace App\Http\Controllers\Profiles;

use Auth;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function getProfile($slug)
    {
        return view("pages.admin.profiles.profile", [

        ]);
    }
}
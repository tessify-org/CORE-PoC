<?php

namespace App\Http\Controllers\Profiles;

use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function getProfile($slug = null)
    {
        if (is_null($slug))
        {
            $user = Auth::user();
        }
        else
        {
            $user = User::where("slug", $slug)->first();
        }

        if (!$user)
        {
            flash("We konden de opgegeven gebruiker niet vinden!")->error();
            return redirect()->route("members");
        }

        return view("pages.profiles.profile", [
            "user" => $user,
        ]);
    }
}
<?php

namespace App\Http\Controllers\Profiles;

use Auth;
use Users;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profiles\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function getProfile($slug = null)
    {
        $user = is_null($slug) ? Auth::user() : User::where("slug", $slug)->first();
        if (!$user)
        {
            flash("We konden de opgegeven gebruiker niet vinden!")->error();
            return redirect()->route("memberlist");
        }

        return view("pages.profiles.profile", [
            "user" => $user,
        ]);
    }

    public function getUpdateProfile()
    {
        return view("pages.profiles.update-profile", [
            "user" => Auth::user(),
            "oldInput" => collect([
                "annotation" => old("annotation"),
                "first_name" => old("first_name"),
                "last_name" => old("last_name"),
                "email" => old("email"),
                "phone" => old("phone"),
                "current_assignment_id" => old("current_assignment_id"),
            ]),
        ]);
    }

    public function postUpdateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->annotation = $request->annotation;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        flash("Wijzigingen zijn opgeslagen!")->success();
        return redirect()->route("profile");
    }
}
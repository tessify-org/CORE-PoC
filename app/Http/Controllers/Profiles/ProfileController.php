<?php

namespace App\Http\Controllers\Profiles;

use Auth;

use Users;
use JobTitles;
use Ministries;
use Departments;
use Organizations;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profiles\UpdateProfileRequest;

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
            "ministries" => Ministries::getAll(),
            "organizations" => Organizations::getAll(),
            "departments" => Departments::getAll(),
            "jobTitles" => JobTitles::getAll(),
            "oldInput" => collect([
                "annotation" => old("annotation"),
                "first_name" => old("first_name"),
                "last_name" => old("last_name"),
                "email" => old("email"),
                "phone" => old("phone"),
                "current_assignment_id" => old("current_assignment_id"),
                "assignments" => old("assignments")
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

        Users::updateAssignments($user, $request);

        flash("Wijzigingen zijn opgeslagen!")->success();
        return redirect()->route("profile");
    }
}
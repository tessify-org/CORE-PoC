<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view("pages.auth.login", [
            "oldInput" => collect([
                "email" => old("email"),
            ])
        ]);
    }

    public function postLogin(LoginRequest $request)
    {
        if (!Auth::attempt(["email" => $request->email, "password" => $request->password]))
        {
            flash("Het wachtwoord was incorrect, probeer het opnieuw.")->error();
            return redirect()->route("auth.login");
        }
        
        $user = User::where("email", $request->email)->first();
        
        flash("Welkom terug ".$user->name)->success();
        return redirect()->route("home");
    }
}
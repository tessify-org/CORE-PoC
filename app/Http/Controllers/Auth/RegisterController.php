<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function getRegister()
    {
        return view("pages.auth.register", [
            "oldInput" => collect([
                "name" => old("name"),
                "email" => old("email"),
            ])
        ]);
    }

    public function postRegister(RegisterRequest $request)
    {
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password
        ]);

        Auth::login($user);

        flash("Bedankt voor je registratie! Je bent automatisch ingelogd.")->success();
        return redirect()->route("home");
    }
}
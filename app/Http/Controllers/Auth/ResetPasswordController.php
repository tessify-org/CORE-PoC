<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    public function getResetPassword($email, $code)
    {
        return view("pages.auth.reset-password", [
            "email" => $email,
            "code" => $code,
        ]);
    }

    public function postResetPassword(ResetPasswordRequest $request, $email, $code)
    {
        dd($request->all());
    }
}
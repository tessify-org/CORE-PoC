<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function getLogout()
    {
        Auth::logout();
        
        flash("Tot de volgende keer!")->success();
        return redirect()->route("home");
    }
}
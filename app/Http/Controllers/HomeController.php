<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function getHome()
    {
        return view("pages.home", [
            "headerImages" => collect([
                asset("storage/images/backgrounds/denhaag.jpg"),
                asset("storage/images/backgrounds/denhaag2.jpg"),
                asset("storage/images/backgrounds/denhaag3.jpg"),
            ])
        ]);
    }
}
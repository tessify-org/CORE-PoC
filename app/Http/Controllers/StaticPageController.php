<?php

namespace App\Http\Controllers;

class StaticPageController extends Controller
{
    public function getStaticPage()
    {
        return view("pages.static.page");
    }
}
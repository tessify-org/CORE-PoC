<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;

class JobBoardController extends Controller
{
    public function getJobBoard()
    {
        return view("pages.jobs.overview", [

        ]);
    }

    public function getJob($slug)
    {
        
        return view("pages.jobs.view", [
            
        ]);
    }
}
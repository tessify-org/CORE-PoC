<?php

use App\Models\User;
use App\Models\Job;
use App\Models\JobStatus;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("jobs")->delete();
        DB::table("job_statuses")->delete();

        $open = JobStatus::create(["name" => "open", "label" => "Open"]);
        $closed = JobStatus::create(["name" => "closed", "label" => "Closed"]);

        $user = User::where("email", "nick.verheijen@minbzk.nl")->first();

        factory(Job::class, 10)->create([
            "author_id" => $user->id,
            "job_status_id" => $open->id,
        ]);
    }
}

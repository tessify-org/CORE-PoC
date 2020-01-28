<?php

use App\Models\User;
use App\Models\Job;
use App\Models\JobStatus;
use App\Models\JobCategory;
use App\Models\JobResource;
use App\Models\WorkMethod;
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
        DB::table("job_categories")->delete();
        DB::table("work_methods")->delete();

        //
        // Work methods
        // 
        
        $scrum = WorkMethod::create([
            "name" => "scrum",
            "label" => "SCRUM",
            "description" => "Scrum is een framework om op een flexibele manier (software)producten te maken. Er wordt gewerkt in multidisciplinaire teams die in korte sprints, met een vaste lengte van 1 tot 4 weken, werkende (software) producten opleveren. Scrum is een term die afkomstig is uit de rugbysport. Bij een scrum probeert een team samen een doel te bereiken en de wedstrijd te winnen. Samenwerking is heel belangrijk en men moet snel kunnen inspelen op veranderende omstandigheden.",
            "external_url" => "https://nl.wikipedia.org/wiki/Scrum_(softwareontwikkelmethode)",
        ]);

        $kanban = WorkMethod::create([
            "name" => "kanban",
            "label" => "KanBan",
            "description" => "Kanban is een systeem om te signaleren (met bijvoorbeeld kaartjes) wanneer iets nodig is. Kanban kan gebruikt worden om van alles in het leven te organiseren.[1] Kanban is een systeem om de logistieke productieketen te besturen. Kanban werd ontwikkeld door Taiichi Ohno, bij Toyota, om een systeem te vinden waarmee het mogelijk was om een hoog niveau van productie te behalen.",
            "external_url" => "https://nl.wikipedia.org/wiki/Kanban",
        ]);

        $prince2 = WorkMethod::create([
            "name" => "prince2",
            "label" => "Prince2",
            "description" => "PRINCE2 (een acroniem van Projects in Controlled Environments, version 2) is een methode voor projectmanagement. Deze methode is gericht op het management, de besturing en de organisatie van een project. PRINCE2 is ontwikkeld door de Britse semioverheidsorganisatie Office of Government Commerce (OGC).",
            "external_url" => "https://nl.wikipedia.org/wiki/PRINCE2",
        ]);

        //
        // Job statuses
        //

        $open = JobStatus::create(["name" => "open", "label" => "Open"]);
        $closed = JobStatus::create(["name" => "closed", "label" => "Closed"]);

        //
        // Job categories
        //

        $software = JobCategory::create(["name" => "software", "label" => "Software"]);
        $hardware = JobCategory::create(["name" => "hardware", "label" => "Hardware"]);
        $process = JobCategory::create(["name" => "process-improvement", "label" => "Procesverbetering"]);

        //
        // Grab random user
        //

        $user = User::where("email", "nick.verheijen@minbzk.nl")->first();

        //
        // Generate jobs
        //

        factory(Job::class, 10)->create([
            "author_id" => $user->id,
            "work_method_id" => $scrum->id,
            "job_status_id" => $open->id,
            "job_category_id" => $software->id,
        ]);
    }
}

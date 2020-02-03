<?php

use App\Models\Job;
use App\Models\User;
use App\Models\Skill;
use App\Models\TeamRole;
use App\Models\JobStatus;
use App\Models\WorkMethod;
use App\Models\TeamMember;
use App\Models\JobCategory;
use App\Models\JobResource;
use App\Models\TeamMemberApplication;

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
        DB::table("team_roles")->delete();
        DB::table("team_members")->delete();
        DB::table("team_member_applications")->delete();
        DB::table("team_member_team_role")->delete();

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

        $open = JobStatus::create([
            "name" => "open", 
            "label" => "Open"
        ]);
        $closed = JobStatus::create([
            "name" => "closed", 
            "label" => "Closed"
        ]);

        //
        // Job categories
        //

        $software = JobCategory::create([
            "name" => "software", 
            "label" => "Software"
        ]);
        $hardware = JobCategory::create([
            "name" => "hardware", 
            "label" => "Hardware"
        ]);
        $process = JobCategory::create([
            "name" => "process-improvement", 
            "label" => "Procesverbetering"
        ]);

        //
        // Grab random user
        //

        $user = User::where("email", "nick.verheijen@minbzk.nl")->first();

        //
        // Generate jobs
        //

        $skills = Skill::all();
        for ($i = 0; $i < 5; $i++)
        {
            // Create the job
            $job = factory(Job::class)->create([
                "author_id" => $user->id,
                "work_method_id" => $scrum->id,
                "job_status_id" => $open->id,
                "job_category_id" => $software->id,
            ]);
                
            // Role 1
            $role_one = TeamRole::create([
                "job_id" => $job->id,
                "name" => "Developer",
                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras massa tellus, consectetur eu pellentesque id, mollis id ante. Sed accumsan auctor tortor, sit amet blandit ex dapibus ac. Nullam feugiat malesuada felis at malesuada.",
            ]);
            $role_one->skills()->attach([$skills->get(0)->id, $skills->get(1)->id, $skills->get(2)->id]);
            
            // Role 1 team member
            $role_one_member = TeamMember::create([
                "job_id" => $job->id,
                "user_id" => $user->id,
                "title" => $role_one->name,
            ]);
            $role_one_member->teamRoles()->attach($role_one->id);

            // Role 2
            $role_two = TeamRole::create([
                "job_id" => $job->id,
                "name" => "Designer",
                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras massa tellus, consectetur eu pellentesque id, mollis id ante. Sed accumsan auctor tortor, sit amet blandit ex dapibus ac. Nullam feugiat malesuada felis at malesuada.",
            ]);
            $skills = $skills->shuffle();
            $role_two->skills()->attach([$skills->get(0)->id, $skills->get(1)->id, $skills->get(2)->id]);

            // Role 2 applications
            $role_two_application = TeamMemberApplication::create([
                "job_id" => $job->id,
                "user_id" => $user->id,
                "team_role_id" => $role_two->id,
                "motivation" => "I'm the 1337est hax0r",
                "processed" => false,
                "accepted" => false,
            ]);
            
            // Role 3
            $role_three = TeamRole::create([
                "job_id" => $job->id,
                "name" => "Scrum Master",
                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras massa tellus, consectetur eu pellentesque id, mollis id ante. Sed accumsan auctor tortor, sit amet blandit ex dapibus ac. Nullam feugiat malesuada felis at malesuada.",
            ]);
            $skills = $skills->shuffle();
            $role_three->skills()->attach([$skills->get(0)->id, $skills->get(1)->id, $skills->get(2)->id]);
        }
    }
}

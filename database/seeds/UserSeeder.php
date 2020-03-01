<?php

use App\Models\User;

use Tessify\Core\Models\Skill;
use Tessify\Core\Models\Assignment;
use Tessify\Core\Models\AssignmentType;
use Tessify\Core\Models\Organization;
use Tessify\Core\Models\OrganizationDepartment;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->delete();

        //
        // Admin account
        //

        $nick = User::create([
            "first_name" => "Nick",
            "last_name" => "Verheijen",
            "email" => "nick.verheijen@minbzk.nl",
            "password" => bcrypt("engeland"),
            "avatar_url" => "storage/images/users/avatars/nick.jpeg",
            "headline" => "This is the way. I have spoken.",
            "interests" => "I like turtles.",
            "is_admin" => true,
        ]);
        
        $php = Skill::where("name", "PHP")->first();
        $mysql = Skill::where("name", "MySQL")->first();
        $html = Skill::where("name", "HTML")->first();
        $css = Skill::where("name", "CSS")->first();
        $c = Skill::where("name", "C")->first();
        $cpp = Skill::where("name", "C++")->first();
        $cs = Skill::where("name", "C#")->first();
        $net = Skill::where("name", ".NET")->first();
        $python = Skill::where("name", "Python")->first();

        $nick->skills()->attach($php->id, ["mastery" => 8, "description" => "Always room for improvement"]);
        $nick->skills()->attach($mysql->id, ["mastery" => 7, "description" => "Don't ask me to write a join statement please"]);
        $nick->skills()->attach($html->id, ["mastery" => 10, "description" => "Good at creating skeletons"]);
        $nick->skills()->attach($css->id, ["mastery" => 8, "description" => "Always room for improvement"]);
        $nick->skills()->attach($c->id, ["mastery" => 3, "description" => "Always room for improvement"]);
        $nick->skills()->attach($cpp->id, ["mastery" => 5, "description" => "I can write a basic CLI program"]);
        $nick->skills()->attach($cs->id, ["mastery" => 6, "description" => "Intermediate"]);
        $nick->skills()->attach($net->id, ["mastery" => 5, "description" => "8 months of experience"]);
        $nick->skills()->attach($python->id, ["mastery" => 8, "description" => "I can charm the cobra"]);

        $traineeship = AssignmentType::where("name", "traineeship")->first();
        $ssc = Organization::where("name", "Shared Service Center ICT")->first();
        $assignment = Assignment::create([
            "user_id" => $nick->id,
            "assignment_type_id" => $traineeship->id,
            "organization_id" => $ssc->id,
            "organization_location_id" => $ssc->locations->get(0)->id,
            "organization_department_id" => $ssc->departments->get(0)->id,
            "title" => "Innovatie Manager",
            "description" => "De man die lang niet alles kan.",
            "order" => 1,
            "current" => true,
            "start_date" => now()->format("Y-m-d"),
        ]);
        $prevAssignment = Assignment::create([
            "user_id" => $nick->id,
            "assignment_type_id" => $traineeship->id,
            "organization_id" => $ssc->id,
            "organization_location_id" => $ssc->locations->get(0)->id,
            "organization_department_id" => $ssc->departments->get(1)->id,
            "title" => "Mobile Developer",
            "description" => "Mogen spelen met het Xamarin Framework, rijksbrede mobiele applicaties en een rijkshuisstijl voor websites.",
            "order" => 0,
            "current" => false,
            "start_date" => now()->format("Y-m-d"),
            "end_date" => now()->format("Y-m-d"),
        ]);

        //
        // Dummy users
        //

        factory(User::class, 10)->create();
    }
}

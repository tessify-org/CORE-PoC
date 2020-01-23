<?php

use App\Models\User;
use App\Models\Ministry;
use App\Models\Organization;
use App\Models\Department;
use App\Models\JobTitle;
use App\Models\Skill;
use App\Models\Assignment;

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
        // Grab data we need to create the accounts
        //

        $bzk = Ministry::where("abbreviation", "BZK")->first();
        $ezk = Ministry::where("abbreviation", "EZK")->first();

        $ssc = Organization::where("name", "SSC-ICT")->first();
        $ssc_innovatie = Department::where("organization_id", $ssc->id)->where("name", "Innovatie")->first();
        $ssc_mobile_dev = Department::where("organization_id", $ssc->id)->where("name", "Mobile Development")->first();
        
        $dictu = Organization::where("name", "DICTU")->first();
        $dictu_soc = Department::where("organization_id", $dictu->id)->where("name", "Security Operation Center")->first();

        //
        // Admin account
        //

        $nick = User::create([
            "annotation" => "Dhr.",
            "first_name" => "Nick",
            "last_name" => "Verheijen",
            "email" => "nick.verheijen@minbzk.nl",
            "password" => bcrypt("engeland"),
        ]);

        $assignment_one = Assignment::create([
            "ministry_id" => $bzk->id,
            "organization_id" => $ssc->id,
            "department_id" => $ssc_mobile_dev->id,
            "order" => 0,
            "started_at" => "2018-08-01",
            "stopped_at" => "2019-12-01",
        ]);

        $assignment_two = Assignment::create([
            "ministry_id" => $ezk->id,
            "organization_id" => $dictu->id,
            "department_id" => $dictu_soc->id,
            "order" => 1,
            "started_at" => "2019-02-01",
            "stopped_at" => "2019-12-01",
        ]);
        
        $assignment_three = Assignment::create([
            "ministry_id" => $bzk->id,
            "organization_id" => $ssc->id,
            "department_id" => $ssc_innovatie->id,
            "order" => 2,
            "started_at" => "2019-01-01",
        ]);
    }
}

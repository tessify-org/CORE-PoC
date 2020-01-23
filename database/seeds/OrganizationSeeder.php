<?php

use App\Models\Ministry;
use App\Models\Department;
use App\Models\Organization;

use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("ministries")->delete();
        DB::table("departments")->delete();
        DB::table("organizations")->delete();

        //
        // Ministries
        //

        $bzk = Ministry::create([
            "name" => "Ministerie van Binnenlandse Zaken",
            "abbreviation" => "BZK",
        ]);

        $ezk = Ministry::create([
            "name" => "Ministerie van Economische Zaken & Klimaat",
            "abbreviation" => "EZK",
        ]);
        
        //
        // Organizations & departments
        //

        $ssc = Organization::create([
            "ministry_id" => $bzk->id,
            "name" => "SSC-ICT",
        ]);

            $ssc_innovatie = Department::create([
                "organization_id" => $ssc->id,
                "name" => "Innovatie"
            ]);

            $ssc_mobile_dev = Department::create([
                "organization_id" => $ssc->id,
                "name" => "Mobile Development",
            ]);

        $dictu = Organization::create([
            "ministry_id" => $ezk->id,
            "name" => "DICTU",
        ]);

            $dictu_soc = Department::create([
                "organization_id" => $dictu->id,
                "name" => "Security Operation Center",
            ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OrganizationSeeder::class);
        $this->call(FunctionSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(JobSeeder::class);
    }
}

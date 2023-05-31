<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use App\Models\IntendedCollegeList;

class IntendedCollegeMajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $intended_college_majors = Config::get('constants.intended_college_major');

        foreach($intended_college_majors as $intended_college_major){
            IntendedCollegeList::create([
                "name" => $intended_college_major,
                "type" => 1,
            ]);
        }
    }
}

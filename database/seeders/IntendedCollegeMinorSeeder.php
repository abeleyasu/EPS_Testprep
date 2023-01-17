<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use App\Models\IntendedCollegeList;


class IntendedCollegeMinorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $intended_college_minors = Config::get('constants.intended_college_minor');

        foreach($intended_college_minors as $intended_college_minor){
            IntendedCollegeList::create([
                "name" => $intended_college_minor,
                "type" => 2,
            ]);
        }
    }
}

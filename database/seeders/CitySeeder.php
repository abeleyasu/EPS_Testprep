<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HighSchoolResume\Cities;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = config('cities');

        $chunks = collect($cities)->chunk(1000);

        foreach ($chunks as $chunk) {
            Cities::insert($chunk->toArray());
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CostTypes;

class CostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CostTypes::truncate();
        $data = [
            [
                'name' => 'DIRECT COST/YEAR',
                'cost_type' => 'cost',
                'total_field_name' => 'DIRECT COSTS',
                'total_field_key' => 'total_direct_cost',
            ],
            [
                'name' => 'INSTITUTIONAL SCHOLARSHIP AID / YEAR',
                'cost_type' => 'aid',
                'total_field_name' => 'Total Institutional Scholarship Aid / Year',
                'total_field_key' => 'total_merit_aid',
            ],
            [
                'name' => 'NEED-BASED AID / YEAR (FEDERAL, STATE, & INSTITUTIONAL)',
                'cost_type' => 'aid',
                'total_field_name' => 'Total Need-Based Aid / Year (Federal, State, & Institutional)',
                'total_field_key' => 'total_need_based_aid',
            ],
            [
                'name' => 'OUTSIDE SCHOLARSHIP AID / YEAR',
                'cost_type' => 'aid',
                'total_field_name' => 'Total Outside Scholarship Aid / Year',
                'total_field_key' => 'total_outside_scholarship',
            ],
        ];
        foreach ($data as $key => $value) {
            CostTypes::create($value);
        }
    }
}

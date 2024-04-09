<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Belle Cole",
            "first_name" => "Belle",
            "last_name" => "Cole",
            "email" => "admin@example.com",
            "phone" => "1524521548",
            "role" => 1,
            "password" => Hash::make('123456'),
            'email_verified_at' => '2021-09-11 07:32:10'
        ]);
    }
}

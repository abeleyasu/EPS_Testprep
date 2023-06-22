<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserSettings;
use App\Models\User;

class UserSetings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserSettings::truncate();

        $users = User::all();

        foreach ($users as $user) {
            UserSettings::create([
                'user_id' => $user->id,
                'is_receive_sms' => 1,
            ]);
        }
    }
}

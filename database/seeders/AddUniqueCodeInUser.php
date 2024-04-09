<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Service\CommonService;


class AddUniqueCodeInUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $commonservice;

    public function __construct(CommonService $commonservice) {
        $this->commonservice = $commonservice;
    }


    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (empty($user->referral_code)) {
                $code = $this->commonservice->referral_code(6);
                $user->referral_code = $code;
                $user->save();
            }
        }
    }
}

<?php 

namespace App\Service;

use Illuminate\Support\ServiceProvider;
use Exception;
use Illuminate\Support\Str;
use App\Models\User;

class CommonService
{
    public function referral_code($length) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $code = '';
        while (strlen($code) < $length) {
            $code .= $characters[rand(0, $charactersNumber - 1)];
        }
        if (User::where('referral_code', $code)->exists()) {
            $this->referral_code();
        }
        return $code;
    }
}
?>
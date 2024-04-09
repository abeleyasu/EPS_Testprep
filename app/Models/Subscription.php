<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Subscription as CashierSubscription;

class Subscription extends CashierSubscription
{
    use HasFactory;

    public function plan() {
        return $this->belongsTo(Plan::class, 'stripe_price', 'stripe_plan_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

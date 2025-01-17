<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'product_plan';

    protected $fillable = [
        'name',
        'product_id',
        'stripe_plan_id',
        'interval_count',
        'interval',
        'currency',
        'amount',
        'display_amount',
        'status',
        'order_index',
        "inactive_at"
    ];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id')->with('productCategory');
    }
}

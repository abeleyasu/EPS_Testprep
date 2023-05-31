<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInclusion extends Model
{
    use HasFactory;

    protected $table = 'product_inclusion';

    protected $fillable = [
        'product_id',
        'inclusion',
    ];

    public function product() {
        return $this->hasOne(Product::class, 'id','product_id');
    }
}

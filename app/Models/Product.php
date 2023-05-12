<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'product_category_id',
        'stripe_product_id',
        'title',
        'description',
        'discount',
        'sale',
        'status',
    ];

    public function plans()
    {
        return $this->hasMany(Plan::class, 'product_id', 'id');
    }

    public function inclusions()
    {
        return $this->hasMany(ProductInclusion::class, 'product_id', 'id');
    }

    public function productCategory() {
        return $this->hasOne(ProductCategory::class, 'id', 'product_category_id');
    }
}

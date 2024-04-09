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
        'order_index',
    ];

    public function plans()
    {
        return $this->hasMany(Plan::class, 'product_id', 'id')->orderBy('order_index', 'asc');
    }

    public function inclusions()
    {
        return $this->hasMany(ProductInclusion::class, 'product_id', 'id');
    }

    public function productCategory() {
        return $this->hasOne(ProductCategory::class, 'id', 'product_category_id');
    }

    public function user_product_course() {
        return $this->belongsToMany(Courses::class,'course_products', 'product_id', 'course_id');
    }

    public function user_product_milestone() {
        return $this->belongsToMany(Milestone::class,'milestones_products', 'product_id', 'milestone_id');
    }

    public function user_product_module() {
        return $this->belongsToMany(Module::class,'module_products', 'product_id', 'module_id');
    }

    public function user_product_section() {
        return $this->belongsToMany(Section::class,'section_products', 'product_id', 'section_id');
    }

    public function user_product_task() {
        return $this->belongsToMany(Task::class,'task_products', 'product_id', 'task_id');
    }
    
    public function product_practice_tests() {
        return $this->belongsToMany(PracticeTest::class);
    }
}

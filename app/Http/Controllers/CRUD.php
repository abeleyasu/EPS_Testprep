<?php
/**
 * Class CRUD
 * @author ningmar
 * @package App\Http\Controllers
 */

namespace App\Http\Controllers;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait CRUD
{

    public function createFromRequest(Model $model, Request $request) {

        $fillableFields = ($model)->getFillable();
        $fillable_key_value = $request->only($fillableFields);


        return $model->create($fillable_key_value);

    }

    public function updateFromRequest(Model $model, Request $request) {

        $fillableFields = ($model)->getFillable();
        $fillable_key_value = $request->only($fillableFields);

        $model->update($fillable_key_value);
        return $model;

    }


//    public function reorderOnCreate(Model $model,$order) {
//        $reorder_sections = $model->where([
//            ['order','>=', $order],
//        ])->orderBy('order')->get();
//        foreach ($reorder_sections as $section) {
//            $section->update(['order'=> $section->order+1]);
//        }
//    }
}
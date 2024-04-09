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
        if($request->files->get('course_cover_image')){
            
            $file= $request->files->get('course_cover_image');
            $filename= date('YmdHis').'.'.$file->getClientOriginalExtension();
            $file->move((public_path().'/public/Image'), $filename);
            $fillable_key_value['coverimage'] = $filename;
        }else{
			$fillable_key_value['coverimage'] = '';
		}
        // if($request->section_id != ''){
        //     $fillable_key_value['status'] = 1;
        // }

        return $model->create($fillable_key_value);

    }

    public function updateFromRequest(Model $model, Request $request) {

        $fillableFields = ($model)->getFillable();
        $fillable_key_value = $request->only($fillableFields);
        if($request->files->get('course_cover_image')){
            
            $file= $request->files->get('course_cover_image');
            $filename= date('YmdHis').'.'.$file->getClientOriginalExtension();
            $file->move((public_path().'/public/Image'), $filename);
            $fillable_key_value['coverimage'] = $filename;
        } else {
            $filename = $request->course_cover_image_old;
        }

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
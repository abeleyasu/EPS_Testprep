<?php

use App\Http\Controllers\CourseManagement\CourseController;
use App\Http\Controllers\CourseManagement\MilestoneController;
use App\Http\Controllers\CourseManagement\ModuleController;
use App\Http\Controllers\CourseManagement\SectionController;
use App\Http\Controllers\CourseManagement\TaskController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' =>'api'],function() {
    Route::post('tags',[TagController::class,'storeJson']);
    Route::post('courses/all',[CourseController::class,'all']);
	Route::post('courses/{id}/reorder',[CourseController::class,'reorder']);
    Route::post('modules/{id}/sections',[SectionController::class,'sectionsByModule']);
//    Route::post('modules/{id}/reorder',[SectionController::class,'sectionsByModule']);
    Route::post('modules/{id}/reorder',[ModuleController::class,'reorder']);
    Route::post('modules/{id}/sections-all', [SectionController::class, 'sectionJson']);

    Route::post('milestones/all',[MilestoneController::class,'all']);
    Route::post('milestone/{id}/modules',[ModuleController::class,'getByMilestone']);
    Route::post('milestone/{id}/reorder',[MilestoneController::class,'reorder']);

    Route::post('sections/{id}/reorder',[SectionController::class,'reorder']);
    Route::post('sections/{id}/reorder',[SectionController::class,'reorder']);
    Route::post('task/{task}/change-status', [TaskController::class, 'changeStatusJson']);

});
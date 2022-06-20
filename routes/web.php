<?php

use App\Http\Controllers\ContentCategoryController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\PassagesController;
use App\Http\Controllers\CourseManagement\ModuleController;
use App\Http\Controllers\CourseManagement\SectionController;
use App\Http\Controllers\CourseManagement\TaskController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\QuizTagController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseManagement\MilestoneController;
use App\Http\Controllers\CourseManagement\CourseController;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\QuizManagemet\QuestionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('signin'));
})->name('home');

//Auth Routes
Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [AuthController::class, 'showSignIn'])->name('signin');
    Route::post('/signin', [AuthController::class, 'userSignIn'])->name('post-signin');
    Route::get('/register', [AuthController::class, 'showSignUp'])->name('signup');
    Route::post('/signup', [AuthController::class, 'userSignUp'])->name('post-signup');
    Route::get('forget-password', [AuthController::class, 'showForgetPassword'])->name('password.request');
    Route::post('forget-password', [AuthController::class, 'postForgetPassword'])->name('password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'resetPasswordView'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});
Route::get('/logout', [AuthController::class, 'signOut'])->name('signout');

//Admin Routes
Route::group(['middleware' => ['role:super_admin'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');
    Route::get('/user_list', [AdminController::class, 'userList'])->name('admin-user-list');
    Route::get('/create_user', [AdminController::class, 'showCreateUser'])->name('admin-create-user');
    Route::post('/create_user', [AdminController::class, 'createUser'])->name('admin-post-create-user');
    Route::get('/edit_user/{id}', [AdminController::class, 'showEditUser'])->name('admin-edit-user');
    Route::post('/edit_user', [AdminController::class, 'updateUser'])->name('admin-update-user');
    Route::post('/delete_user', [AdminController::class, 'deleteUser'])->name('admin-delete-user');
    Route::group(['prefix' => 'course-management'], function () {
        Route::resource('courses', CoursesController::class);
        Route::post('courses/{course}/courseupdate', [CoursesController::class, 'courseupdate'])->name('courses.courseupdate');
        Route::resource('courseslist', CourseController::class);
		Route::post('courseslist/{course}/courseupdate', [CourseController::class, 'courseupdate'])->name('courseslist.courseupdate');
		Route::get('courseslist/{course}/preview', [MilestoneController::class, 'preview'])->name('courseslist.preview');
        Route::resource('milestones', MilestoneController::class);
        Route::get('milestones/{milestone}/preview', [MilestoneController::class, 'preview'])->name('milestones.preview');
        Route::resource('modules', ModuleController::class);
		Route::get('modules/{module}/preview', [ModuleController::class, 'preview'])->name('modules.preview');
        Route::resource('sections', SectionController::class);
		Route::get('sections/{section}/preview', [SectionController::class, 'preview'])->name('sections.preview');
        Route::resource('tasks', TaskController::class);
		Route::get('tasks/{task}/preview', [TaskController::class, 'preview'])->name('tasks.preview');
    });
    Route::resource('tags', TagController::class);
    Route::resource('quiztags', QuizTagController::class);
    Route::resource('content-categories', ContentCategoryController::class);
    
    Route::resource('passages', PassagesController::class);
    Route::get('passages/{passage}/preview', [PassagesController::class, 'preview'])->name('passages.preview');
    // questions
    Route::resource('questions', QuestionsController::class);
});

//User Routes
Route::group(['middleware' => ['role:standard_user'], 'prefix' => 'user'], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user-dashboard');
    Route::get('/resume', [UserController::class, 'resume'])->name('resume');
    Route::get('/courses', [MilestoneController::class, 'studentIndex'])->name('courses.index');
    Route::get('/courses/{milestone}/detail', [MilestoneController::class, 'show'])->name('courses.detail');
    Route::get('/modules/{module}/detail', [ModuleController::class, 'show'])->name('modules.detail');
    Route::get('/sections/{section}/detail', [SectionController::class, 'show'])->name('sections.detail');
    Route::get('/sections/{section}/show-detail', [SectionController::class, 'showDetail'])->name('sections.show-detail');
    Route::get('/tasks/{task}/detail', [TaskController::class, 'show'])->name('tasks.detail');
    Route::get('/tasks/{task}/show-detail', [TaskController::class, 'showDetail'])->name('tasks.show-detail');
    Route::post('task/{task}/change-status', [TaskController::class, 'changeStatus'])->name('tasks.change_status');
});

<?php

use App\Http\Controllers\ContentCategoryController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\PassagesController;
use App\Http\Controllers\CourseManagement\ModuleController;
use App\Http\Controllers\CourseManagement\SectionController;
use App\Http\Controllers\CourseManagement\TaskController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\QuizTagController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\CourseManagement\MilestoneController;
use App\Http\Controllers\CourseManagement\CourseController;
use App\Http\Controllers\HighSchoolResume\ActivityController;
use App\Http\Controllers\HighSchoolResume\EducationController;
use App\Http\Controllers\HighSchoolResume\EmploymentCertificationController;
use App\Http\Controllers\HighSchoolResume\FeaturedAttributeController;
use App\Http\Controllers\HighSchoolResume\HonorsController;
use App\Http\Controllers\HighSchoolResume\PersonalInfoController;
use App\Http\Controllers\HighSchoolResume\PreviewController;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\QuizManagemet\QuestionsController;
use \App\Http\Controllers\QuizManagemet\PracticeTestsController;
use \App\Http\Controllers\QuizManagemet\PracticeQuestionController;
use App\Http\Controllers\TestPrepController;
use App\Http\Controllers\UserCalendarController;

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
        // Route::post('courseslist', CourseController::class);
        Route::post('courseslist/{course}/courseupdate', [CourseController::class, 'courseupdate'])->name('courseslist.courseupdate');
        Route::get('courses/{course}/preview', [CourseController::class, 'preview'])->name('courses.preview');
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
    Route::resource('categories', CategoryController::class);
    Route::post('categories/update_data/{id}', [CategoryController::class, 'update_data'])->name('categories.update_data');
    Route::resource('sub_categories', SubCategoryController::class);
    Route::resource('quiztags', QuizTagController::class);
    Route::resource('content-categories', ContentCategoryController::class);

    Route::resource('passages', PassagesController::class);
    Route::get('passages/{passage}/preview', [PassagesController::class, 'preview'])->name('passages.preview');
    // Route::put('categories/{category}/', [CategoryController::class])->name('categories');
    // questions
    Route::resource('questions', QuestionsController::class);
    Route::resource('practicetests', PracticeTestsController::class);
    Route::post('addPracticeQuestion', [PracticeQuestionController::class, 'addPracticeQuestion'])->name('addPracticeQuestion');
    Route::post('getPracticePassage', [PracticeQuestionController::class, 'getPracticePassage'])->name('getPracticePassage');
    Route::post('addPracticeTestSection', [PracticeQuestionController::class, 'addPracticeTestSection'])->name('addPracticeTestSection');
    Route::post('updatePracticeQuestion', [PracticeQuestionController::class, 'updatePracticeQuestion'])->name('updatePracticeQuestion');
    Route::post('getPracticeQuestionById', [PracticeQuestionController::class, 'getPracticeQuestionById'])->name('getPracticeQuestionById');
    Route::post('deletePracticeQuestionById', [PracticeQuestionController::class, 'deletePracticeQuestionById'])->name('deletePracticeQuestionById');
    Route::post('sectionOrder', [PracticeQuestionController::class, 'sectionOrder'])->name('sectionOrder');
    Route::post('questionOrder', [PracticeQuestionController::class, 'questionOrder'])->name('questionOrder');
});

//User Routes
Route::group(['middleware' => ['role:standard_user'], 'prefix' => 'user'], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user-dashboard');
    Route::get('/resume', [UserController::class, 'resume'])->name('resume');
    Route::get('/courses', [MilestoneController::class, 'studentIndex'])->name('courses.index');
    Route::get('/courses/{course}/detail', [CoursesController::class, 'show'])->name('courses.detail');
    Route::get('/courses/{course}/milestone', [CoursesController::class, 'UserCourseDetail'])->name('courses.milestone');
    Route::get('/milestone/{milestone}/detail', [MilestoneController::class, 'show'])->name('milestone.detail');
    Route::get('/modules/{module}/detail', [ModuleController::class, 'show'])->name('modules.detail');
    Route::get('/sections/{section}/detail', [SectionController::class, 'show'])->name('sections.detail');
    Route::get('/sections/{section}/show-detail', [SectionController::class, 'showDetail'])->name('sections.show-detail');
    Route::get('/tasks/{task}/detail', [TaskController::class, 'show'])->name('tasks.detail');
    Route::get('/tasks/{task}/show-detail', [TaskController::class, 'showDetail'])->name('tasks.show-detail');
    Route::post('/task/{task}/change-status', [TaskController::class, 'changeStatus'])->name('tasks.change_status');
    Route::get('/clearCache', [UserController::class, 'clearCache']);
    Route::view('student-view-dashboard', 'user/student-view-dashboard');

    //Route::view('practice-test-sections', 'user/practice-test-sections');
    Route::get('/practice-test-sections/{id}', [TestPrepController::class, 'singleTest'])->name('single_test');

    Route::view('/practice-test-sections', 'user.practice-test-sections');
    Route::view('/practice-test', 'user.practice-test')->name('practicetest');

    Route::group(['prefix' => 'calendar', 'as' => 'calendar'], function(){
        Route::get('/', [CalendarEventController::class, 'index']);
        Route::post('/add-events', [CalendarEventController::class, 'store'])->name('.addEvent');
        Route::delete('/trash-event/{id}', [CalendarEventController::class, 'destroy'])->name('.trashEvent');
        Route::post('/assign-events', [UserCalendarController::class, 'store'])->name('.assignEvent');
        Route::post('/resize-events', [UserCalendarController::class, 'resizeEvent'])->name('.resizeEvent');
        Route::delete('/delete-event/{id}', [UserCalendarController::class, 'deleteEvent'])->name('.deleteEvent');
        Route::put('/update-event/{id}', [UserCalendarController::class, 'updateEvent'])->name('.updateEvent');
        Route::post('/add-assign-event', [UserCalendarController::class, 'addAssignEvent'])->name('.addAssignEvent');
        Route::get('/get-event/{id}', [UserCalendarController::class, 'getEventById'])->name('.getEventById');
    });

    Route::group(['prefix' => 'admin-dashboard', 'as' => 'admin-dashboard.'], function(){
        Route::group(['prefix' => 'high-school-resume', 'as' => 'highSchoolResume.'], function(){
            Route::get('/list', [PreviewController::class, 'list'])->name('list');
            Route::controller(PersonalInfoController::class)->group(function(){
                Route::get('/personal-info', 'index')->name('personalInfo');
                Route::post('/personal-info', 'store')->name('personalInfo.store');
                Route::put('/personal-info/{personalInfo}', 'update')->name('personalInfo.update');
            });
            Route::controller(EducationController::class)->group(function(){
                Route::get('/education-info', 'index')->name('educationInfo');
                Route::post('/education-info','store')->name('educationInfo.store');
                Route::put('/education-info/{education}', 'update')->name('educationInfo.update');
            });
            Route::controller(HonorsController::class)->group(function(){
                Route::get('/honors', 'index')->name('honors');
                Route::post('/honors', 'store')->name('honors.store');
                Route::put('/honors/{honor}', 'update')->name('honors.update');
            });
            Route::controller(ActivityController::class)->group(function(){
                Route::get('/activities', 'index')->name('activities');
                Route::post('/activities', 'store')->name('activities.store');
                Route::put('/activities/{activity}', 'update')->name('activities.update');
            });
            Route::controller(EmploymentCertificationController::class)->group(function(){
                Route::get('/employment-certifications', 'index')->name('employmentCertification');
                Route::post('/employment-certifications', 'store')->name('employmentCertification.store');
                Route::put('/employment-certifications/{employmentCertification}', 'update')->name('employmentCertification.update');
            });
            Route::controller(FeaturedAttributeController::class)->group(function(){
                Route::get('/features-attributes', 'index')->name('featuresAttributes');
                Route::post('/features-attributes', 'store')->name('featuresAttributes.store');
                Route::put('/features-attributes/{featuredAttribute}', 'update')->name('featuresAttributes.update');
            });
            Route::controller(PreviewController::class)->group(function(){
                Route::get('/preview', 'index')->name('preview');
                Route::get('/pdf/preview', 'resumePreview')->name('pdf.preview');
                Route::get('/resume/complete', 'resumeComplete')->name('resume.complete');
                Route::get('/resume/download/{id}', 'resumeDownload')->name('resume.download');
                Route::delete('/resume/delete/{id}', 'destroy')->name('resume.destroy');
            });
        });
        
        Route::view('/initial-college-list', 'user.admin-dashboard.initial-college-list')->name('initialCollegeList');
        Route::view('/college-application-deadline', 'user.admin-dashboard.college-application-deadline')->name('collegeApplicationDeadline');
        Route::view('/cost-comparison', 'user.admin-dashboard.cost-comparison')->name('costComparison');
    });
    
    Route::get('/practice-test/{id}', [TestPrepController::class, 'singleSection'])->name('single_section');

    Route::get('/practice-test/all/{id}', [TestPrepController::class, 'allSection'])->name('all_section');

    Route::post('/get_section_questions/post', [TestPrepController::class, 'get_questions']);

    Route::post('/set_user_question_answer/post', [TestPrepController::class, 'set_answers']);
    // Please make any changes you think it's necessary to routing 
    Route::get('/test-prep-dashboard', [TestPrepController::class, 'dashboard'])->name('test_prep_dashboard');
});

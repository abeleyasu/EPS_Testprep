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
use App\Http\Controllers\CareerExplorationController;
use App\Http\Controllers\CollegeApplicationDeadlineController;
use App\Http\Controllers\CollegeInformationController;
use App\Http\Controllers\CourseManagement\MilestoneController;
use App\Http\Controllers\CourseManagement\CourseController;
use App\Http\Controllers\EducationCourseController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\HighSchoolResume\ActivityController;
use App\Http\Controllers\HighSchoolResume\EducationController;
use App\Http\Controllers\HighSchoolResume\EmploymentCertificationController;
use App\Http\Controllers\HighSchoolResume\FeaturedAttributeController;
use App\Http\Controllers\HighSchoolResume\HonorsController;
use App\Http\Controllers\HighSchoolResume\PersonalInfoController;
use App\Http\Controllers\HighSchoolResume\PreviewController;
use App\Http\Controllers\HonorsCourseNameListController;
use App\Http\Controllers\InitialCollegeList\AcademicStatisticsController;
use App\Http\Controllers\InitialCollegeList\CollegeSearchResultsController;
use App\Http\Controllers\InitialCollegeList\SelectingSearchParamsController;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\QuizManagemet\QuestionsController;
use \App\Http\Controllers\QuizManagemet\PracticeTestsController;
use \App\Http\Controllers\QuizManagemet\PracticeQuestionController;
use App\Http\Controllers\ResumeSettingsController;
use App\Http\Controllers\TestPrepController;
use App\Http\Controllers\TestReview\TestReviewController;
use App\Http\Controllers\UserCalendarController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\AthleticPositionController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\VerifyEmailController;

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
    return redirect('login');
});

Route::group(['middleware' => ['auth', 'cors', 'verified']], function () {
    //Admin Routes
    Route::group(['middleware' => ['role:super_admin'], 'prefix' => 'admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');
        Route::get('/user_list', [AdminController::class, 'userList'])->name('admin-user-list');
        Route::get('/create_user', [AdminController::class, 'showCreateUser'])->name('admin-create-user');
        Route::post('/create_user', [AdminController::class, 'createUser'])->name('admin-post-create-user');
        Route::get('/edit_user/{id}', [AdminController::class, 'showEditUser'])->name('admin-edit-user');
        Route::post('/edit_user', [AdminController::class, 'updateUser'])->name('admin-update-user');
        Route::post('/delete_user', [AdminController::class, 'deleteUser'])->name('admin-delete-user');
        Route::group(['prefix' => 'high-school-resume', 'as' => 'admin.highSchoolResume.'], function () {
            Route::controller(ResumeSettingsController::class)->group(function () {
                Route::get('/settings', 'index')->name('settings');
            });
            Route::controller(EducationCourseController::class)->group(function () {
                Route::post('/add_course', 'store')->name('addCourse');
                Route::get('/fetch_course/{educationCourse}', 'edit')->name('fetchCourse');
                Route::get('/fetch_all_course', 'fetchAllCourse')->name('fetchAllCourse');
                Route::put('/update_course/{educationCourse}', 'update')->name('updateCourse');
                Route::delete('/delete_course/{id}', 'destroy')->name('deleteCourse');
            });
        });
        Route::group(['prefix' => 'course-management'], function () {
            Route::resource('courses', CoursesController::class);
            Route::post('courses/{course}/courseupdate', [CoursesController::class, 'course_update'])->name('courses.courseupdate');
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
        Route::get('get-passages-by-format/{format}', [QuestionsController::class, 'getPassagesByFormat']);
        Route::resource('practicetests', PracticeTestsController::class);
        Route::post('addPracticeQuestion', [PracticeQuestionController::class, 'addPracticeQuestion'])->name('addPracticeQuestion');

        Route::post('addPracticeTest', [PracticeTestsController::class, 'addPracticeTest'])->name('addPracticeTest');

        Route::post('addPracticeCategoryType', [PracticeQuestionController::class, 'addPracticeCategoryType'])->name('addPracticeCategoryType');
        Route::post('addPracticeQuestionType', [PracticeQuestionController::class, 'addPracticeQuestionType'])->name('addPracticeQuestionType');
        Route::get('getPracticeCategoryType', [PracticeQuestionController::class, 'getPracticeCategoryType'])->name('getPracticeCategoryType');
        Route::get('getPracticeQuestionType', [PracticeQuestionController::class, 'getPracticeQuestionType'])->name('getPracticeQuestionType');


        Route::post('getSectionQuestions', [PracticeQuestionController::class, 'getSectionQuestions'])->name('getSectionQuestions');

        Route::post('getPracticePassage', [PracticeQuestionController::class, 'getPracticePassage'])->name('getPracticePassage');
        Route::post('addPracticeTestSection', [PracticeQuestionController::class, 'addPracticeTestSection'])->name('addPracticeTestSection');
        Route::post('updatePracticeQuestion', [PracticeQuestionController::class, 'updatePracticeQuestion'])->name('updatePracticeQuestion');
        Route::post('getPracticeQuestionById', [PracticeQuestionController::class, 'getPracticeQuestionById'])->name('getPracticeQuestionById');
        Route::post('deletePracticeQuestionById', [PracticeQuestionController::class, 'deletePracticeQuestionById'])->name('deletePracticeQuestionById');
        Route::post('sectionOrder', [PracticeQuestionController::class, 'sectionOrder'])->name('sectionOrder');
        Route::post('questionOrder', [PracticeQuestionController::class, 'questionOrder'])->name('questionOrder');
        // new 
        Route::post('editSection', [PracticeQuestionController::class, 'editSection'])->name('edit_section');
        Route::post('updateSection', [PracticeQuestionController::class, 'updateSection'])->name('update_section');
        Route::post('deleteSection', [PracticeQuestionController::class, 'deleteSection'])->name('delete_section');

        Route::get('/question-type/add', [PracticeQuestionController::class, 'addQuestionType'])->name('add_question_type');
        Route::get('/question-type/edit/{id}', [PracticeQuestionController::class, 'editQuestionTypes'])->name('edit_question_type');
        Route::post('/storequestiontype', [PracticeQuestionController::class, 'storeQuestionType'])->name('storeQuestionType');
        Route::post('/updatequestiontype', [PracticeQuestionController::class, 'updateQuestionType'])->name('updateQuestionType');
        Route::post('/deletequestiontype', [PracticeQuestionController::class, 'deleteQuestionType'])->name('deleteQuestionType');
        Route::get('/question-type', [PracticeQuestionController::class, 'indexQuestionType'])->name('indexQuestionType');

        Route::get('/category-type/add', [PracticeQuestionController::class, 'addCategoryType'])->name('add_category_type');
        Route::get('/category-type/edit/{id}', [PracticeQuestionController::class, 'editCategoryTypes'])->name('edit_category_type');
        Route::post('/store-category-type', [PracticeQuestionController::class, 'storeCategoryType'])->name('storeCategoryType');
        Route::post('/update-category-type', [PracticeQuestionController::class, 'updateCategoryType'])->name('updateCategoryType');
        Route::post('/delete-category-type', [PracticeQuestionController::class, 'deleteCategoryType'])->name('deleteCategoryType');
        Route::get('/category-type', [PracticeQuestionController::class, 'indexCategoryType'])->name('indexCategoryType');
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
        Route::get('/practice-tests/{test}/{id}/review-page', [TestPrepController::class, 'singleReview'])->name('single_review');
        // new 
        Route::get('/practice-tests/{testId}/{id}', [TestPrepController::class, 'resetSection'])->name('reset_section');
        Route::get('/practice-tests-reset/{id}/review-page', [TestPrepController::class, 'resetTest'])->name('reset_test');

        Route::any('/profile', [UserController::class, 'profile'])->name('user.edit-profile');
        Route::any('/settings', [UserController::class, 'settings'])->name('user.settings');
        Route::any('/settings_updatepass', [UserController::class, 'settings_update'])->name('user.settings_update');
        Route::any('/cost_comparison', [UserController::class, 'cost_comparison'])->name('user.cost_comparison');
        Route::any('/compare', [UserController::class, 'compare'])->name('user.compare');

        Route::get('/practice-test-sections/{id}', [TestPrepController::class, 'singleTest'])->name('single_test');

        Route::view('/practice-test-sections', 'user.practice-test-sections');
        Route::view('/practice-test', 'user.practice-test')->name('practicetest');

        Route::group(['prefix' => 'calendar', 'as' => 'calendar'], function () {
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

        Route::group(['prefix' => 'admin-dashboard', 'as' => 'admin-dashboard.'], function () {
            Route::group(['prefix' => 'high-school-resume', 'as' => 'highSchoolResume.'], function () {
                Route::get('/list', [PreviewController::class, 'list'])->name('list');
                Route::controller(PersonalInfoController::class)->group(function () {
                    Route::get('/personal-info', 'index')->name('personalInfo');
                    Route::post('/personal-info/store', 'store')->name('personalInfo.store');
                    Route::put('/personal-info/{personalInfo}', 'update')->name('personalInfo.update');
                    Route::get('/discard-drafts', 'discard_drafts')->name('discarddrafts');
                    Route::get('edit-fetch/{editid}', 'editFetch')->name('editFetch');
                    Route::get('get-cities-by-state/{state_id}', 'getCity')->name('getCity');
                });
                Route::controller(EducationController::class)->group(function () {
                    Route::get('/education-info', 'index')->name('educationInfo');
                    Route::post('/education-info/store', 'store')->name('educationInfo.store');
                    Route::put('/education-info/{education}', 'update')->name('educationInfo.update');
                });
                Route::controller(HonorsController::class)->group(function () {
                    Route::get('/honors', 'index')->name('honors');
                    Route::post('/honors/store', 'store')->name('honors.store');
                    Route::put('/honors/{honor}', 'update')->name('honors.update');
                });
                Route::controller(ActivityController::class)->group(function () {
                    Route::get('/activities', 'index')->name('activities');
                    Route::post('/activities/store', 'store')->name('activities.store');
                    Route::put('/activities/{activity}', 'update')->name('activities.update');
                });
                Route::controller(EmploymentCertificationController::class)->group(function () {
                    Route::get('/employment-certifications', 'index')->name('employmentCertification');
                    Route::post('/employment-certifications/store', 'store')->name('employmentCertification.store');
                    Route::put('/employment-certifications/{employmentCertification}', 'update')->name('employmentCertification.update');
                });
                Route::controller(FeaturedAttributeController::class)->group(function () {
                    Route::get('/features-attributes', 'index')->name('featuresAttributes');
                    Route::post('/features-attributes/store', 'store')->name('featuresAttributes.store');
                    Route::put('/features-attributes/{featuredAttribute}', 'update')->name('featuresAttributes.update');
                });
                Route::controller(PreviewController::class)->group(function () {
                    Route::get('/preview', 'index')->name('preview');
                    Route::get('/pdf/preview', 'resumePreview')->name('pdf.preview');
                    Route::get('/resume/complete', 'resumeComplete')->name('resume.complete');
                    Route::get('/resume/download/{id}/{type}', 'resumeDownload')->name('resume.download');
                    Route::delete('/resume/delete/{id}', 'destroy')->name('resume.destroy');
                    Route::get('/fetch-resume/{id}', 'fetchResume')->name('fetch.resume');
                });
            });
            Route::get('/college-application-deadline', [CollegeApplicationDeadlineController::class, 'index'])->name('collegeApplicationDeadline');
            Route::post('/college_save', [CollegeApplicationDeadlineController::class, 'college_save'])->name('college_save');
            Route::post('/college_application_save', [CollegeApplicationDeadlineController::class, 'college_application_save'])->name('college_application_save');
            Route::group(['prefix' => 'initial-college-list', 'as' => 'initialCollegeList.'], function () {
                Route::controller(SelectingSearchParamsController::class)->group(function () {
                    Route::get('/selecting-search-params', 'index')->name('selectingSearchParams');
                });
                Route::controller(CollegeSearchResultsController::class)->group(function () {
                    Route::get('/college-search-results', 'index')->name('CollegeSearchResults');
                });
                Route::controller(AcademicStatisticsController::class)->group(function () {
                    Route::get('/academic-statistics', 'index')->name('AcademicStatistics');
                });
            });
            Route::view('/cost-comparison', 'user.admin-dashboard.cost-comparison')->name('costComparison');
            Route::get('/career-exploration', [CareerExplorationController::class, 'index'])->name('careerExploration');
        });

        Route::group(['prefix' => 'test-review', 'as' => 'test-review.'], function () {
            Route::get('/', [TestReviewController::class, 'index'])->name('review');
            Route::get('/question-concept-review', [TestReviewController::class, 'questionConceptReview'])->name('question-concept-review');
            Route::get('/category-question-type', [TestReviewController::class, 'categoryQuestionType'])->name('category-question-type');
            Route::get('/answer-type', [TestReviewController::class, 'answerType'])->name('answer-type');
        });

        Route::get('/honors/courses/list', [HonorsCourseNameListController::class, 'getCourseNameList'])->name('honorsCourseList');
        Route::get('/colleges/list', [CollegeInformationController::class, 'getCollegeList'])->name('collegesList');
        Route::get('/grades/list', [GradesController::class, 'getGradeList'])->name('gradesList');
        Route::get('/status/list', [StatusController::class, 'getStatusList'])->name('statusList');
        Route::get('/awards/list', [AwardController::class, 'getAwardList'])->name('awardsList');
        Route::get('/organizations/list', [OrganizationController::class, 'getOrganizationList'])->name('organizationsList');
        Route::get('/position/list', [PositionController::class, 'getPositionsList'])->name('positionsList');
        Route::get('/athletic/position/list', [AthleticPositionController::class, 'getAthleticPositionsList'])->name('positionsList');

        Route::get('/practice-test/{id}', [TestPrepController::class, 'singleSection'])->name('single_section');

        Route::get('/practice-test/all/{id}', [TestPrepController::class, 'allSection'])->name('all_section');

        Route::post('/get_section_questions/post', [TestPrepController::class, 'get_questions']);

        Route::post('/set_user_question_answer/post', [TestPrepController::class, 'set_answers']);
        // Please make any changes you think it's necessary to routing 
        Route::get('/test-prep-dashboard', [TestPrepController::class, 'dashboard'])->name('test_prep_dashboard');

        Route::post('/set_scroll_position/post', [TestPrepController::class, 'set_scrollPosition']);
        Route::post('/get_scroll_position/post', [TestPrepController::class, 'get_scrollPosition']);
    });

    Route::get('/logout', [AuthController::class, 'signOut'])->name('signout');
});

// Auth Routes
Route::group(['middleware' => ['guest', 'cors']], function () {
    Route::get('/login', [AuthController::class, 'showSignIn'])->name('signin');
    Route::post('/signin', [AuthController::class, 'userSignIn'])->name('post-signin');
    Route::get('/register', [AuthController::class, 'showSignUp'])->name('signup');
    Route::post('/signup', [AuthController::class, 'userSignUp'])->name('post-signup');
    Route::get('forget-password', [AuthController::class, 'showForgetPassword'])->name('password.request');
    Route::post('forget-password', [AuthController::class, 'postForgetPassword'])->name('password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'resetPasswordView'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/verify-email', [VerifyEmailController::class, 'send'])->name('verification.notice');
    Route::post('/email/verification-notification', [VerifyEmailController::class, 'resend'])->middleware(['throttle:6,1'])->name('verification.resend');
});
Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, 'verfiy'])->name('verification.verify');

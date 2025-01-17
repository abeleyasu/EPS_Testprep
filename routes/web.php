<?php

use App\Models\PracticeTest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuizTagController;
use App\Http\Controllers\RewardsController;
use App\Http\Controllers\AdmissionDashBoard;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PassagesController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\TestPrepController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StateCityController;
use App\Http\Controllers\WorksheetController;
use App\Http\Controllers\Cronjob\SendReminder;
use App\Http\Controllers\CustomQuizController;
use App\Http\Controllers\DiffRatingController;
use App\Http\Controllers\UserSurveyController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\QuestionTagController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserCalendarController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\SuperCategoryController;
use App\Http\Controllers\ResumeSettingsController;
use App\Http\Controllers\ContentCategoryController;
use App\Http\Controllers\EducationCourseController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\AthleticPositionController;
use App\Http\Controllers\CareerExplorationController;
use App\Http\Controllers\CollegeInformationController;
use App\Http\Controllers\HonorsCourseNameListController;
use App\Http\Controllers\CourseManagement\TaskController;
use App\Http\Controllers\Cronjob\FetchCollegeInformation;

use App\Http\Controllers\TestReview\TestReviewController;
use App\Http\Controllers\Cronjob\CollegeMajorInformationc;
use App\Http\Controllers\CourseManagement\CourseController;
use App\Http\Controllers\CourseManagement\ModuleController;
use App\Http\Controllers\HighSchoolResume\HonorsController;
use \App\Http\Controllers\QuizManagemet\QuestionsController;
use App\Http\Controllers\CourseManagement\SectionController;
use App\Http\Controllers\HighSchoolResume\PreviewController;
use App\Http\Controllers\HighSchoolResume\ActivityController;
use App\Http\Controllers\SelfMadeTest\SelfMadeTestController;
use App\Http\Controllers\CollegeApplicationDeadlineController;
use App\Http\Controllers\CourseManagement\MilestoneController;
use App\Http\Controllers\HighSchoolResume\EducationController;
use \App\Http\Controllers\QuizManagemet\PracticeTestsController;
use App\Http\Controllers\HighSchoolResume\PersonalInfoController;
use \App\Http\Controllers\QuizManagemet\PracticeQuestionController;
use App\Http\Controllers\UserDeadlineNotificationSettingsController;
use App\Http\Controllers\HighSchoolResume\FeaturedAttributeController;
use App\Http\Controllers\InitialCollegeList\InititalCollegeListController;
use App\Http\Controllers\HighSchoolResume\EmploymentCertificationController;

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

// Route::get('/', function () {
//     Session::flush();
//     return redirect('login');
// })->name('home');
Route::group(['middleware' => ['auth', 'cors']], function () {
    //Admin Routes
    Route::group(['middleware' => ['role:super_admin', 'email_verification'], 'prefix' => 'admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');
        Route::get('/user/list', [AdminController::class, 'userList'])->name('admin-user-list');
        Route::get('/user/info/{id}', [AdminController::class, 'singleUserInfor'])->name('admin-user-info');
        Route::patch('/user/change-status/{id}', [AdminController::class, 'updateUserStatus'])->name('admin-user-change-status');
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

        Route::group(['prefix' => 'admission-management', 'as' => 'admin.admission-management.'], function () {
            Route::group(['prefix' => 'college-information', 'as' => 'college-information.'], function () {
                Route::controller(CollegeInformationController::class)->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/edit/{id}', 'editView')->name('edit');
                    Route::post('/edit', 'update')->name('update');
                    Route::post('/import_csv', 'import_csv')->name('import_csv');
                    Route::post('/import_ug_expense_asgns', 'import_ug_expense_asgns')->name('import_ug_expense_asgns');
                    Route::post('/import_ug_admission', 'import_ug_expense_asgns')->name('import_ug_expense_asgns');
                    Route::post('/import_ug_admis', 'import_ug_admis')->name('import_ug_admis');
                    Route::post('/import_ug_enroll', 'import_ug_enroll')->name('import_ug_enroll');
                    Route::post('/import_ug_campus', 'import_ug_campus')->name('import_ug_campus');
                    Route::post('/import_ux_inst', 'import_ux_inst')->name('import_ux_inst');
                });
            });
        });

        Route::group(['prefix' => 'college-information', 'as' => 'admin.worksheet-management.'], function () {
            Route::controller(WorksheetController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/edit', 'update')->name('update');
                Route::delete('/{id}', 'delete')->name('delete');
            });
        });

        Route::group(['prefix' => 'course-management'], function () {
            Route::resource('courses', CoursesController::class);
            Route::get('/courses/{course}/detail', [CoursesController::class, 'show'])->name('courses.detail');
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
        Route::resource('custom-quizzes', CustomQuizController::class);
        Route::resource('questiontags', QuestionTagController::class);
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
        //new for diff ratings
        Route::resource('diffratings', DiffRatingController::class);
        Route::resource('supercategories', SuperCategoryController::class);
        Route::post('addSelfMadeSuperCategory', [SuperCategoryController::class, 'addSelfMadeSuperCategory'])->name('addSelfMadeSuperCategory');
        Route::post('removeSelfMadeSuperCategory', [SuperCategoryController::class, 'removeSelfMadeSuperCategory'])->name('removeSelfMadeSuperCategory');
        Route::post('addSelfMadeCategory', [PracticeQuestionController::class, 'addSelfMadeCategory'])->name('addSelfMadeCategory');
        Route::post('removeSelfMadeCategory', [PracticeQuestionController::class, 'removeSelfMadeCategory'])->name('removeSelfMadeCategory');
        Route::post('addSelfMadeQuestionType', [PracticeQuestionController::class, 'addSelfMadeQuestionType'])->name('addSelfMadeQuestionType');
        Route::post('removeSelfMadeQuestionType', [PracticeQuestionController::class, 'removeSelfMadeQuestionType'])->name('removeSelfMadeQuestionType');
        Route::post('addSelfMadeQuestionTag', [PracticeQuestionController::class, 'addSelfMadeQuestionTag'])->name('addSelfMadeQuestionTag');
        Route::post('removeSelfMadeQuestionTag', [PracticeQuestionController::class, 'removeSelfMadeQuestionTag'])->name('removeSelfMadeQuestionTag');
        Route::post('addPracticeQuestion', [PracticeQuestionController::class, 'addPracticeQuestion'])->name('addPracticeQuestion');
        //new
        Route::post('/score/save', [PracticeQuestionController::class, 'saveScore'])->name('score_save');
        Route::post('/check/score', [PracticeQuestionController::class, 'checkScore'])->name('check_score');
        Route::post('/check/digi-score', [PracticeQuestionController::class, 'digiCheckScore'])->name('digi_check_score');
        Route::post('/check/section', [PracticeQuestionController::class, 'checkSectionType'])->name('check_section_type');

        Route::post('addPracticeTest', [PracticeTestsController::class, 'addPracticeTest'])->name('addPracticeTest');
        Route::post('addDropdownOption', [PracticeTestsController::class, 'addDropdownOption'])->name('addDropdownOption');

        Route::post('addPracticeCategoryType', [PracticeQuestionController::class, 'addPracticeCategoryType'])->name('addPracticeCategoryType');
        Route::post('addPracticeQuestionType', [PracticeQuestionController::class, 'addPracticeQuestionType'])->name('addPracticeQuestionType');
        Route::post('addSuperCategory', [PracticeQuestionController::class, 'addSuperCategory'])->name('addSuperCategory');
        Route::post('addDiffRating', [PracticeQuestionController::class, 'addDiffRating'])->name('addDiffRating');
        Route::post('addQuestionTag', [PracticeQuestionController::class, 'addQuestionTag'])->name('addQuestionTag');
        Route::get('getPracticeCategoryType', [PracticeQuestionController::class, 'getPracticeCategoryType'])->name('getPracticeCategoryType');
        Route::get('getPracticeQuestionType', [PracticeQuestionController::class, 'getPracticeQuestionType'])->name('getPracticeQuestionType');
        Route::get('getSuperCategory', [PracticeQuestionController::class, 'getSuperCategory'])->name('getSuperCategory');


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
        Route::post('/find-super-category', [PracticeQuestionController::class, 'findSuperCategory'])->name('findSuperCategory');
        Route::post('/find-category', [PracticeQuestionController::class, 'findCategory'])->name('findCategory');
        Route::post('/update-category-type', [PracticeQuestionController::class, 'updateCategoryType'])->name('updateCategoryType');
        Route::post('/delete-category-type', [PracticeQuestionController::class, 'deleteCategoryType'])->name('deleteCategoryType');
        Route::get('/category-type', [PracticeQuestionController::class, 'indexCategoryType'])->name('indexCategoryType');

        Route::group(['as' => 'admin.'], function () {
            Route::group(['prefix' => 'product-category', 'as' => 'category.'], function () {
                Route::get('/list', [ProductCategoryController::class, 'index'])->name('list');
                Route::get('/get-list', [ProductCategoryController::class, 'displayRecords'])->name('category_list');
                Route::get('/create', [ProductCategoryController::class, 'show'])->name('create');
                Route::post('/create', [ProductCategoryController::class, 'create'])->name('category_create');
                Route::get('/edit/{id}', [ProductCategoryController::class, 'editshow'])->name('edit');
                Route::post('/edit', [ProductCategoryController::class, 'edit'])->name('category_edit');
                Route::post('/delete', [ProductCategoryController::class, 'deleyeCateogry'])->name('category_delete');
                Route::post('/change-order', [ProductCategoryController::class, 'changeOrder'])->name('category_change_order');

                Route::get('ajax/categories', [ProductCategoryController::class, 'ajaxCategories'])->name('ajax_categories');
            });

            Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
                Route::get('/list', [ProductController::class, 'index'])->name('list');
                Route::get('/get-list', [ProductController::class, 'displayRecords'])->name('product_list');
                Route::get('/create', [ProductController::class, 'show'])->name('create');
                Route::post('/create', [ProductController::class, 'create'])->name('product_create');
                Route::get('/edit/{id}', [ProductController::class, 'editshow'])->name('edit');
                Route::post('/edit', [ProductController::class, 'edit'])->name('product_edit');
                Route::post('/delete', [ProductController::class, 'deleteProduct'])->name('product_delete');
                Route::post('/change-order', [ProductController::class, 'changeOrder'])->name('product_change_order');

                Route::get('/ajax/products', [ProductController::class, 'ajaxProducts'])->name('ajax_products');
                Route::post('ajax/create', [ProductController::class, 'ajaxCreate'])->name('ajax_create');

                Route::get('/permission/{id}', [ProductController::class, 'productPermission'])->name('productPermission');
                Route::post('/permission/attach', [ProductController::class, 'attachPermission'])->name('attachPermission');

                Route::get('/permission-list', [ProductController::class, 'permissions'])->name('permission');
            });

            Route::group(['prefix' => 'plan', 'as' => 'plan.'], function () {
                Route::get('/list', [PlanController::class, 'index'])->name('list');
                Route::get('/get-list', [PlanController::class, 'displayRecords'])->name('plan_list');
                Route::get('/create', [PlanController::class, 'show'])->name('create');
                Route::post('create', [PlanController::class, 'create'])->name('plan_create');
                Route::get('/edit/{id}', [PlanController::class, 'editshow'])->name('edit');
                Route::post('/edit', [PlanController::class, 'edit'])->name('plan_edit');
                Route::post('/delete', [PlanController::class, 'deletePlan'])->name('plan_delete');
                Route::get('/changePlanStatus/{id}', [PlanController::class, 'changePlanStatus'])->name('changePlanStatus');
                Route::post('/change-order', [PlanController::class, 'changeOrder'])->name('plan_change_order');
                Route::get('/get-product/{id}', [PlanController::class, 'getProduct'])->name('get_product');
            });
        });

        Route::group(['prefix' => 'roles', 'as' => 'admin.roles.'], function () {
            Route::controller(RolesController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/attach-permission/{id}', 'permissionList')->name('permission-list');
                Route::post('/attach-permission', 'attachPermission')->name('attach-permission');

                Route::patch('change/role/status/{id}', 'changeRoleStatus')->name('change-role-status');

                Route::get('/ajax/roles', 'ajaxRoles')->name('ajax_roles');
            });
        });

        Route::group(['prefix' => 'permissions', 'as' => 'admin.permissions.'], function () {
            Route::controller(PermissionsController::class)->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });

        Route::group(['prefix' => 'settings', 'as' => 'admin.setting.'], function () {
            Route::controller(AdminSettingsController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('save/free-subscription-setting', 'subscriptionSetting')->name('subscription-settings');
            });
        });

        Route::group(['prefix' => 'subscription', 'as' => 'admin.subscription.'], function () {
            Route::controller(SubscriptionController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{id}', 'getSubscriptionInfo')->name('subscription-info');
                Route::post('/comsumed/{subscriptionId}', 'consumendUserSubscription')->name('consumed-subscription');
                Route::get('/comsumed/{id}', 'getConsumendUserSubscription')->name('consumed-subscription-detail');
                Route::get('/consumed/get/{id}', 'getSingleConsumedDetails')->name('consumed-subscription-single-detail');
                Route::delete('/comsumed/{id}', 'deleteConsumedHour')->name('consumed-subscription-delete');
            });
        });

        Route::group(['prefix' => 'survey', 'as' => 'admin.survey.'], function () {
            Route::controller(UserSurveyController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{id}', 'getSurveyInfo')->name('survey-info');
            });
        });
    });

    //User Routes
    Route::group(['middleware' => ['role:standard_user', 'email_verification'], 'prefix' => 'user'], function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('user-dashboard');
        Route::get('/resume', [UserController::class, 'resume'])->name('resume');
        Route::post('/addNotesToQuestionReview', [TestPrepController::class, 'addNotesToQuestionReview'])->name('addNotesToQuestionReview');

        Route::group(['middleware' => ['subscription_valid:access-courses']], function () {
            Route::get('/courses', [MilestoneController::class, 'studentIndex'])->name('courses.index');
            Route::get('/courses/{course}/milestone', [CoursesController::class, 'UserCourseDetail'])->name('courses.milestone');
            Route::get('/milestone/{milestone}/detail', [MilestoneController::class, 'show'])->name('milestone.detail');
            Route::get('/modules/{module}/detail', [ModuleController::class, 'show'])->name('modules.detail');
            Route::get('/sections/{section}/detail', [SectionController::class, 'show'])->name('sections.detail');
            Route::get('/sections/{section}/show-detail', [SectionController::class, 'showDetail'])->name('sections.show-detail');
            Route::get('/tasks/{task}/detail', [TaskController::class, 'show'])->name('tasks.detail');
            Route::get('/tasks/{task}/show-detail', [TaskController::class, 'showDetail'])->name('tasks.show-detail');
            Route::post('/task/{task}/change-status', [TaskController::class, 'changeStatus'])->name('tasks.change_status');
        });


        Route::get('/clearCache', [UserController::class, 'clearCache']);
        Route::post('/billing-detail', [UserController::class, 'studentBillingDetails'])->name('user.billing-detail');

        Route::view('student-view-dashboard', 'user/student-view-dashboard');
        Route::get('/practice-tests/{test}/{id}/review-page', [TestPrepController::class, 'singleReview'])->name('single_review');
        Route::get('/practice-tests/multiple-sections-review-page', [TestPrepController::class, 'singleReviewShow'])->name('multiple_review');
        // new
        Route::get('/practice-tests/{testId}/{id}', [TestPrepController::class, 'resetSection'])->name('reset_section');
        Route::get('/practice-tests-proctored/{testId}/{id}', [TestPrepController::class, 'resetProctoredSection'])->name('reset_proc_section');
        Route::get('/practice-tests-reset/{id}/review-page', [TestPrepController::class, 'resetTest'])->name('reset_test');

        Route::get('test-prep-insights',[TestPrepController::class,'allTestInsights'])->name('all-test');
        Route::get('single/test-prep-insights',[TestPrepController::class,'getSingleTestInsight']);
        Route::get('get-tests',[TestPrepController::class,'getAllTest']);
        Route::get('select/test-prep-insights',[TestPrepController::class,'selectFormat'])->name('test-prep-insights');
        Route::patch('setting/update', [UserSettingsController::class, 'updateUserSettings'])->name('update-user-settings');

        Route::any('/profile', [UserController::class, 'profile'])->name('user.edit-profile');
        Route::any('/compare', [UserController::class, 'compare'])->name('user.compare');

        Route::get('/get-cities/{state_id}', [UserController::class, 'getCity'])->name('user.get-city');
        Route::get('/billing-detail', [UserController::class, 'billing_details'])->name('user.get-billing-detail');
        Route::post('/basic_billing-detail', [UserController::class, 'save_basic_details'])->name('user.save-billing-detail');
        Route::post('/billing-detail', [UserController::class, 'studentBillingDetails'])->name('user.billing-detail');

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
            Route::get('/get-all-events', [UserCalendarController::class, 'getAllEvent'])->name('.getAllEvents');
        });

        Route::group(['middleware' => ['subscription_valid:access-reminders']], function () {
            Route::any('/reminders', [UserController::class, 'reminders'])->name('user.reminders');
            Route::any('/reminders-submit', [UserController::class, 'store'])->name('user.reminders.submit');
            Route::any('/reminders-update/{id}', [UserController::class, 'update'])->name('user.reminders.update');
            Route::delete('/reminders-delete/{id}', [UserController::class, 'delete'])->name('user.reminders.delete');
            Route::any('/settings', [UserController::class, 'settings'])->name('user.settings');
            Route::any('/settings_updatepass', [UserController::class, 'settings_update'])->name('user.settings_update');
        });

        Route::group(['prefix' => 'admissions', 'as' => 'admin-dashboard.'], function () {

            Route::group(['middleware' => ['subscription_valid:access-admission-dashboard']], function () {
                Route::get('/dashboard', [DashboardController::class, 'admission_dashboard'])->name('dashboard');
            });

            Route::group(['prefix' => 'high-school-resume', 'as' => 'highSchoolResume.', 'middleware' => ['subscription_valid:access-high-school-resume']], function () {
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


            Route::group(['middleware' => ['subscription_valid:access-college-application-deadline-organizer']], function () {
                Route::get('/college-application-deadline/list', [CollegeApplicationDeadlineController::class, 'getApplicationDeadlineData'])->name('getApplicationDeadlineData');
                Route::get('/college-application-deadline/{id}', [CollegeApplicationDeadlineController::class, 'getSingleApplicationData'])->name('getSingleApplicationData');
                Route::get('/college-application-deadline', [CollegeApplicationDeadlineController::class, 'index'])->name('collegeApplicationDeadline');
                Route::post('/college_application_save', [CollegeApplicationDeadlineController::class, 'college_application_save'])->name('college_application_save');
                Route::post('/set-application-completed', [CollegeApplicationDeadlineController::class, 'set_application_completed'])->name('set_application_completed');

                Route::get('/get-college-list', [CollegeApplicationDeadlineController::class, 'list'])->name('collegeApplicationDeadline.collegeList');
                Route::post('/college_save', [InititalCollegeListController::class, 'collegeSave'])->name('collegeApplicationDeadline.college_save');

                Route::post('reset-application-deadline', [CollegeApplicationDeadlineController::class, 'resetApplicationDeadlineData'])->name('resetApplicationDeadlineData');
            });

            Route::post('college-application-notification', [UserDeadlineNotificationSettingsController::class, 'create'])->name('college-application-notification');
            Route::get('college-application-notification', [UserDeadlineNotificationSettingsController::class, 'index'])->name('college-application-notification-list');
            Route::get('college-application-notification/{id}', [UserDeadlineNotificationSettingsController::class, 'get'])->name('college-application-notification-get');
            Route::delete('college-application-notification', [UserDeadlineNotificationSettingsController::class, 'delete'])->name('college-application-notification-delete');


            Route::group(['prefix' => 'initial-college-list', 'as' => 'initialCollegeList.', 'middleware' => ['subscription_valid:access-initial-college-list']], function () {
                Route::get('/search-college/step1', [InititalCollegeListController::class, 'step1'])->name('step1');
                Route::group(['middleware' => ['initialcollegestep']], function () {
                    Route::get('/search-college/step2', [InititalCollegeListController::class, 'step2'])->name('step2');
                    Route::get('/search-college/step3', [InititalCollegeListController::class, 'step3'])->name('step3');
                    Route::get('/search-college/step4', [InititalCollegeListController::class, 'step4'])->name('step4');
                });
                Route::post('/step2/save-college', [InititalCollegeListController::class, 'saveCollege'])->name('step2.saveCollege');
                Route::get('/step2/get-college/{id}', [InititalCollegeListController::class, 'getSingleCollege'])->name('step2.getSingleCollege');
                Route::delete('step2/remove-college/{id}/{sid}', [InititalCollegeListController::class, 'removeCollge'])->name('step2.removeCollge');
                Route::get('/search-college/step4/get-college-list/{id}', [InititalCollegeListController::class, 'getSelectedCollegeList'])->name('step4.getSelectedCollegeList');
                Route::patch('/search-college/step4/update-order/{id}', [InititalCollegeListController::class, 'updateOrder'])->name('step4.updateOrder');
                Route::get('/search-college/step4/get-college/{id}', [InititalCollegeListController::class, 'collegeList'])->name('step4.collegeList');
                Route::patch('/search-college/step4/store-college-selection/{id}', [InititalCollegeListController::class, 'storeSelection'])->name('step4.storeSelection');


                Route::patch('search-college/save/{id}', [InititalcollegeListController::class, 'saveCollegeList'])->name('saveCollegeList');
                Route::patch('search-college/change-status/{id}', [InititalcollegeListController::class, 'changeSearchCollegeAddStatus'])->name('changeSearchCollegeAddStatus');
                Route::get('get-hide-college', [InititalcollegeListController::class, 'getHideCollege'])->name('getHideCollege');
                Route::get('user/get-college-list', [InititalcollegeListController::class, 'getUserCollegeList'])->name('getUserCollegeList');
                Route::delete('user/delete-college-list', [InititalcollegeListController::class, 'deleteAllCollege'])->name('deleteAllCollege');

                Route::put('/step3/save-academic-statistics/{score}/{id}', [InititalCollegeListController::class, 'saveAcademicStatistics'])->name('step3.saveAcademicStatistics');
                Route::post('/store/past-current-score', [InititalcollegeListController::class, 'storePastCurrentScore'])->name('storePastCurrentScore');
                Route::get('/past-current-score/{id}', [InititalcollegeListController::class, 'getPastCurrentScore'])->name('getPastCurrentScore');
                Route::get('/get/past-current-score/{id}', [InititalcollegeListController::class, 'getSinglePastCurrentScore'])->name('getSinglePastCurrentScore');
                Route::delete('/past-current-score/{id}', [InititalcollegeListController::class, 'deletePastCurrentScore'])->name('deletePastCurrentScore');

                Route::delete('remove-user-college/{id}', [InititalcollegeListController::class, 'removeUserCollege'])->name('remove-user-college');
            });

            Route::group(['prefix' => 'cost-comparison', 'middleware' => ['subscription_valid:access-cost-comparison-tool']], function () {
                Route::any('/', [InititalCollegeListController::class, 'viewCostComparisonPage'])->name('cost_comparison');
                Route::get('get', [InititalCollegeListController::class, 'getCostComparisonSummary'])->name('cost_comparison.get_cost_comparison_summary');
                Route::get('get-college-list', [InititalCollegeListController::class, 'getCollegeWiseList'])->name('cost_comparison.get_college_list_for_cost_comparison');
                Route::get('get-single-cost-details/{id}', [InititalCollegeListController::class, 'getSingleCostDetails'])->name('cost_comparison.get_single_cost_details');
                Route::patch('save-cost-details', [InititalCollegeListController::class, 'saveCollegeCost'])->name('cost_comparison.save_cost_comparison_details');
                Route::patch('edit-college-detail/{id}', [InititalCollegeListController::class, 'editCollegeDetails'])->name('cost_comparison.edit_college_detail');
                Route::delete('delete-cost-details/{id}', [InititalCollegeListController::class, 'deleteCollegeCost'])->name('cost_comparison.delete_cost_details');
                Route::post('reset-cost-comparison-data', [InititalCollegeListController::class, 'resetCostComparisonData'])->name('cost_comparison.reset-cost-comparion-data');
            });

            Route::get('/career-exploration', [CareerExplorationController::class, 'index'])->name('careerExploration');
        });

        Route::group(['prefix' => 'test-review', 'as' => 'test-review.'], function () {
            Route::get('/', [TestReviewController::class, 'index'])->name('review');
            Route::get('/question-concept-review', [TestReviewController::class, 'questionConceptReview'])->name('question-concept-review');
            Route::get('/category-question-type', [TestReviewController::class, 'categoryQuestionType'])->name('category-question-type');
            Route::get('/answer-type', [TestReviewController::class, 'answerType'])->name('answer-type');
        });

        Route::get('/education/courses/list', [EducationController::class, 'getEducationCourseNameList'])->name('educationCourseList');
        Route::get('/honors/courses/list', [HonorsCourseNameListController::class, 'getCourseNameList'])->name('honorsCourseList');
        Route::get('/colleges/list', [CollegeInformationController::class, 'getCollegeList'])->name('collegesList');
        Route::get('/grades/list', [GradesController::class, 'getGradeList'])->name('gradesList');
        Route::get('/status/list', [StatusController::class, 'getStatusList'])->name('statusList');
        Route::get('/awards/list', [AwardController::class, 'getAwardList'])->name('awardsList');
        Route::get('/organizations/list', [OrganizationController::class, 'getOrganizationList'])->name('organizationsList');
        Route::get('/position/list', [PositionController::class, 'getPositionsList'])->name('positionsList');
        Route::get('/athletic/position/list', [AthleticPositionController::class, 'getAthleticPositionsList'])->name('positionsList');

        Route::group(['middleware' => ['subscription_valid:access-test-home-page']], function () {
            Route::get('/test-home-page', [TestPrepController::class, 'testHomePage'])->name('test_home_page');
            Route::get('/test-home-page-history', [TestPrepController::class, 'testHomePageHistory'])->name('test_home_page_history');
            Route::get('/select-test-page/{id}', [TestPrepController::class, 'selectTestPage'])->name('select-test');
            Route::get('/practice-test-sections/{id}', [TestPrepController::class, 'singleTest'])->name('single_test');
            Route::get('/test-break/{id}', [TestPrepController::class, 'testBreak'])->name('testBreak');

            Route::view('/practice-test', 'user.practice-test')->name('practicetest');
            Route::get('/start-all-sections/{sec_id}/{str}/{id}', [TestPrepController::class, 'startAllSections'])->name('startAllSections');
            Route::get('/practice-test/{id}', [TestPrepController::class, 'singleSection'])->name('single_section');
            Route::get('/official-practice-test/{id}', [TestPrepController::class, 'singleOfficeSection'])->name('official_single_section');
            Route::get('/official-practice-test-module-2/{id}', [TestPrepController::class, 'singleModuleOfficeSection'])->name('official_module_single_section');
            Route::get('/get-official-test', [TestPrepController::class, 'getQuestionSection'])->name('get_official_tests');
            Route::get('/practice-test/all/{id}', [TestPrepController::class, 'allSection'])->name('all_section');
        });
        Route::view('/practice-test-sections', 'user.practice-test-sections');

        Route::group(['middleware' => ['subscription_valid:access-self-made-tests']], function () {
            Route::resource('self-made-test', SelfMadeTestController::class);
        });

        Route::post('/get_section_questions/post', [TestPrepController::class, 'get_questions']);
        Route::post('/get_official_section_questions/post', [TestPrepController::class, 'get_official_questions']);

        Route::post('/set_user_question_answer/post', [TestPrepController::class, 'set_answers']);
        Route::post('/test-progress/store', [TestPrepController::class, 'test_progress_store']);
        Route::post('/check_progress', [TestPrepController::class, 'check_progress'])->name('check_progress');
        // Please make any changes you think it's necessary to routing
        Route::group(['middleware' => ['subscription_valid:access-test-prep-dashboard']], function () {
            Route::get('/test-prep-dashboard', [DashboardController::class, 'test_prep_dashboard'])->name('test_prep_dashboard');
        });
        Route::post('/update_test_type', [TestPrepController::class, 'update_test_type'])->name('update_test_type');

        Route::post('/set_scroll_position/post', [TestPrepController::class, 'set_scrollPosition']);
        Route::post('/get_scroll_position/post', [TestPrepController::class, 'get_scrollPosition']);

        Route::post('/gettypes', [TestPrepController::class, 'gettypes'])->name('gettypes');
        Route::post('/getAllTypes', [TestPrepController::class, 'getAllTypes'])->name('getAllTypes');
        Route::post('/getDSAAllTypes', [TestPrepController::class, 'getDSAAllTypes'])->name('getDSAAllTypes');
        Route::post('/generate-custom-quiz', [TestPrepController::class, 'generateCustomQuiz'])->name('generateCustomQuiz');
        Route::post('/getSelfMadeTestQuestion', [TestPrepController::class, 'getSelfMadeTestQuestion'])->name('getSelfMadeTestQuestion');
        Route::post('/addMistakeType', [TestPrepController::class, 'addMistakeType'])->name('addMistakeType');
        Route::post('/changeTitleSelfMade', [TestPrepController::class, 'changeTitleSelfMade'])->name('changeTitleSelfMade');
        Route::post('/get_time', [TestPrepController::class, 'get_time'])->name('get_time');

        //plans and subscription
        Route::post('/delete/card', [UserController::class, 'deleteCard'])->name('user.delete.card');
        Route::get('/plans', [PlanController::class, 'getUserPlan'])->name('plan.index');
        Route::get('/plans/{plan}', [PlanController::class, 'showPlan'])->name('plans.show');
        Route::post('subscription', [PlanController::class, 'subscription'])->name("subscription.create");
        Route::get('/my-subscription', [SubscriptionController::class, 'mysubscriptions'])->name('mysubscriptions.index');
        Route::post('/cancel-subscription', [SubscriptionController::class, 'cancelsubscriptions'])->name('mysubscriptions.cancel');
        Route::post('/resume-subscription', [SubscriptionController::class, 'resumesubscriptions'])->name('mysubscriptions.resume');
        Route::post('/subscription/renweval', [SubscriptionController::class, 'offSubscriptionAutoRenewval'])->name('mysubscriptions.renewal');
        Route::get('subscription/download-invoice/{id}', [SubscriptionController::class, 'downloadUserInvoice'])->name('mysubscriptions.download-invoice');
        Route::post('/subscription-create', [PlanController::class, 'subscriptioncreatewithexistingcard'])->name('subscriptions.create-custome');
        Route::get('/set-as-default/{payment_id}', [UserController::class, 'setAsDefaultCard'])->name('user.setAsDefault');
        Route::post('/validate-referral-code', [PlanController::class, 'validateReferralCode'])->name('validate-referral-code');

        Route::controller(UserSurveyController::class)->group(function () {
            Route::get('/survey', 'surveyForm')->name('survey-form');
            Route::post('/survey', 'saveSurvey')->name('survey-form-submit');
        });

        Route::controller(RewardsController::class)->group(function () {
            Route::group(['prefix' => 'rewards', 'as' => 'rewards.'], function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'sendReferralNotification')->name('send-notification');
            });
        });
    });

    Route::controller(GoogleController::class)->group(function () {
        Route::get('auth/google', 'google')->name('google');
        Route::get('auth/google/callback', 'googleCallback')->name('googleCallback');
        Route::group(['prefix' => 'google', 'as' => 'google.'], function () {
            Route::get('/disconnect/google', 'disconnect')->name('disconnect');
            Route::get('/calendars', 'getCalenders')->name('calendars');
            Route::delete('/calendar', 'deleteCalender')->name('delete-calender');
            Route::patch('show/calendar', 'showCalender')->name('show-calender');
            Route::get('/create/calender', 'storeUserCalender')->name('create-user-calender');
        });
    });
    Route::controller(StateCityController::class)->group(function () {
        Route::get('get/states', 'states')->name('get-states');
        Route::get('get/cities/{id}', 'city')->name('get-cities');
    });

    Route::get('/logout', [AuthController::class, 'signOut'])->name('signout');

    Route::get('/{code}', [RewardsController::class, 'getCode'])->name('get-code');
});

// Auth Routes
Route::group(['middleware' => ['guest', 'cors']], function () {
    // Route::get('/login', [AuthController::class, 'showSignIn'])->name('signin');
    Route::post('/signin', [AuthController::class, 'userSignIn'])->name('post-signin');
    // Route::get('/register', [AuthController::class, 'showSignUp'])->name('signup');
    Route::post('/signup', [AuthController::class, 'userSignUp'])->name('post-signup');
    Route::post('/check-email', [AuthController::class, 'checkEmail'])->name('check-email');
    Route::get('forget-password', [AuthController::class, 'showForgetPassword'])->name('password.request');
    Route::post('forget-password', [AuthController::class, 'postForgetPassword'])->name('password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'resetPasswordView'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
    Route::get('/pricing', [PlanController::class, 'getPlanForNonUser'])->name('simple-pricing');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/email/verification-notification', [VerifyEmailController::class, 'resend'])->middleware(['throttle:6,1'])->name('verification.resend');
});

Route::group(['middleware' => ['auth']], function () {
    // Route::get('/verify-email', [VerifyEmailController::class, 'send'])->name('verification.notice');
});
Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, 'verfiy'])->name('verification.verify');
Route::get('/sendreminder', [SendReminder::class, 'index']);
Route::get('/static/fetchcollegeinformation', [FetchCollegeInformation::class, 'index']);
Route::get('/colleges/search', [EducationController::class, 'searchColleges']);
Route::get('/collegemajor', [CollegeMajorInformationc::class, 'index']);

Route::get('/list/get-all-events', [UserCalendarController::class, 'getAllEvent'])->name('.getAllEvents');

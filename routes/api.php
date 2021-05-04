<?php

use App\Http\Controllers\FeesModeTypeController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\StudentCourseRegistrationController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DurationTypeController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("login",[UserController::class,'login']);



Route::post("register",[UserController::class,'register']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::get("user",[UserController::class,'getCurrentUser']);
    Route::get("logout",[UserController::class,'logout']);

    //get all users
    Route::get("users",[UserController::class,'getAllUsers']);


});




Route::group(array('prefix' => 'dev'), function() {
    // student related API address placed in a group for better readability
    Route::group(array('prefix' => 'students'), function() {
        // এখানে সকলকেই দেখাবে, যাদের কোর্স দেওয়া হয়েছে ও যাদের দেওয়া হয়নি সবাইকেই
        Route::get("/", [StudentController::class, 'index']);
        Route::get("/studentId/{id}", [StudentController::class, 'get_student_by_id']);

        // কোন একজন student এর কি কি কোর্স আছে তা দেখার জন্য, যে গুলো চলছে বা শেষ হয়ে গেছে সবই
        Route::get("/studentId/{id}/courses", [StudentController::class, 'get_courses_by_id']);
        // কোন একজন student এর কি কি কোর্স শেষ হয়ে গেছে।
        Route::get("/studentId/{id}/completedCourses", [StudentController::class, 'get_completed_courses_by_id']);
        // কোন একজন student এর কি কি কোর্স চলছে।
        Route::get("/studentId/{id}/incompleteCourses", [StudentController::class, 'get_incomplete_courses_by_id']);

        //যে সব স্টুডেন্টদের কোর্স দেওয়া হয়েছে তাদের পাওয়ার জন্য, যাদের শেষ হয়ে গেছে তাদেরকেও দেখানো হবে।
        Route::get("/registered/yes", [StudentController::class, 'get_all_course_registered_students']);
        //যে সব স্টুডেন্টের নাম নথিভুক্ত হওয়ার পরেও তাদের কোন কোর্স দেওয়া হয়নি তাদের পাওয়ার জন্য
        Route::get("/registered/no", [StudentController::class, 'get_all_non_course_registered_students']);
        //যে সব স্টুডেন্টের কোর্স বর্তমানে চলছে তাদের দেখার জন্য আমি এটা ব্যবহার করেছি। যাদের শেষ হয়ে গেছে তাদেরকেও দেখানো হবে না।
        Route::get("/registered/current", [StudentController::class, 'get_all_current_course_registered_students']);
        Route::get("/isDeletable/{id}", [StudentController::class, 'is_deletable_student']);

        Route::post("/",[StudentController::class, 'store']);
        Route::patch("/",[StudentController::class, 'update']);
        Route::delete("/{id}",[StudentController::class, 'delete']);
    });


    //course
    Route::get("courses",[CourseController::class, 'index']);
    Route::get("courses/{id}",[CourseController::class, 'index_by_id']);
    Route::post("courses",[CourseController::class, 'store']);

    Route::get("states",[StateController::class, 'index']);
    Route::get("states/{id}",[StateController::class, 'index_by_id']);

    //Fees Modes
    Route::get("feesModeTypes",[FeesModeTypeController::class, 'index']);
    Route::get("feesModeTypes/{id}",[FeesModeTypeController::class, 'index_by_id']);

    //DurationTypes
    Route::get("durationTypes",[DurationTypeController::class, 'index']);
    Route::get("durationTypes/{id}",[DurationTypeController::class, 'indexById']);
    Route::post("durationTypes",[DurationTypeController::class, 'store']);
    Route::patch("durationTypes",[DurationTypeController::class, 'update']);
    Route::delete("durationTypes/{id}",[DurationTypeController::class, 'destroy']);


    Route::get("subjects",[SubjectController::class, 'index']);


    //CourseRegistration
    Route::post("studentCourseRegistrations",[StudentCourseRegistrationController::class, 'store']);
    Route::get("studentCourseRegistrations",[StudentCourseRegistrationController::class, 'index']);
    Route::delete("studentCourseRegistrations/{id}",[StudentCourseRegistrationController::class, 'destroy']);
    Route::patch("studentCourseRegistrations",[StudentCourseRegistrationController::class, 'update']);




    //transactions
    Route::group(array('prefix' => 'transactions'), function() {
        Route::get("/all",[TransactionController::class, 'get_all_transactions']);
        Route::get("/feesCharged",[TransactionController::class, 'get_all_fees_charged_transactions']);

        Route::get("/dues/studentId/{id}",[TransactionController::class, 'get_total_dues_by_student_id']);

        Route::get("/dues/byCourse/studentId/{id}",[TransactionController::class, 'get_student_due_by_student_course_registration_id']);


        //saving fees charged
        Route::post("/feesCharged",[TransactionController::class, 'save_fees_charge']);
        //saving fees received
        Route::post("/feesReceived",[TransactionController::class, 'save_fees_received']);
    });
});


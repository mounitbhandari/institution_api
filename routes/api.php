<?php

use App\Http\Controllers\FeesModeTypeController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\StudentCourseRegistrationController;
use App\Http\Controllers\SubjectController;
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
    //students
    Route::get("students/{id}",[StudentController::class, 'getStudentByID']);
    Route::get("students",[StudentController::class, 'getAllStudent']);
    Route::post("students",[StudentController::class, 'save']);
    Route::patch("students",[StudentController::class, 'update']);
    Route::delete("students/{id}",[StudentController::class, 'delete']);

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
});


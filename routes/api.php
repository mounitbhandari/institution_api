<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;









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
    Route::get("students",[StudentController::class, 'getallStudent']);
    Route::post("students",[StudentController::class, 'save']);
    Route::patch("students",[StudentController::class, 'update']);
<<<<<<< HEAD

    //course
    Route::get("courses",[CourseController::class, 'getallStudent']);

=======
    Route::delete("students/{id}",[StudentController::class, 'delete']);
>>>>>>> 4f1c1947e00eecf543e4ca0519777f7d20258d2b

});


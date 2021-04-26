<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\CourseResource;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses= Course::get();
        return response()->json(['success'=>1,'data'=> CourseResource::collection($courses)], 200,[],JSON_NUMERIC_CHECK);
    }
    public function get_course_by_id($id)
    {
        $courses= Course::findOrFail($id);
        return response()->json(['success'=>1,'data'=> new CourseResource($courses)], 200,[],JSON_NUMERIC_CHECK);
    }

    public function store(Request $request)
    {
        try{
            $course = new Course();
            $course->course_code=$request->input('courseCode');
            $course->short_name=$request->input('shortName');
            $course->full_name=$request->input('fullName');
            $course->course_duration=$request->input('courseDuration');
            $course->description=$request->input('description');
            $course->save();
        }catch(\Exception $e){
            DB::rollBack();
        return response()->json(['success'=>0,'exception'=>$e->getMessage()], 500);
        }
        return response()->json(['success'=>1,'data'=>new CourseResource($course)], 200,[],JSON_NUMERIC_CHECK);
    }

    public function update(Request $request, Course $course)
    {
        //
    }


    public function destroy(Course $course)
    {
        //
    }
}

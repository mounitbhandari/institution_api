<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\StudentResource;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getallStudent()
    {
      $students= Student::get();
      return response()->json(['success'=>1,'data'=> StudentResource::collection($students)], 200,[],JSON_NUMERIC_CHECK);
    }
    public function getStudentByID($id){
        try {
            $student = Student::findOrFail($id);
            return response()->json(['success'=>true,'data'=>new StudentResource($student)], 200,[],JSON_NUMERIC_CHECK);
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'data'=>null], 404,[],JSON_NUMERIC_CHECK);
        }

        // return new StudentResource($student);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'episodeId' => 'required|unique:students,episode_id',
            'studentName' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>0,'data'=>null,'error'=>$validator->messages()], 406,[],JSON_NUMERIC_CHECK);
        }
       try{
            $student= new Student();
            $student->episode_id =$request->input('episodeId');
            $student ->student_name = $request->input('studentName');
            $student->father_name= $request->input('fatherName');
            $student->mother_name= $request->input('motherName');
            $student->guardian_name= $request->input('guardianName');
            $student->relation_to_gurdian= $request->input('relationToGurdian');
            $student->dob= $request->input('dob');
            $student->sex= $request->input('sex');
            $student->address= $request->input('address');
            $student->city= $request->input('city');
            $student->distric= $request->input('distric');
            $student->state_id= $request->input('stateId');
            $student->pin= $request->input('pin');
            $student->gurdian_contact_number= $request->input('gurdianContactNumber');
            $student->whatsapp_number= $request->input('whatsappNumber');
            $student->email_id= $request->input('email');
            $student->qualification= $request->input('qualification');
            $student->save();
            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['success'=>0,'exception'=>$e->getMessage()], 500);
        }

        return response()->json(['success'=>1,'data'=>new StudentResource($student)], 200,[],JSON_NUMERIC_CHECK);
    }

    public function edit(Request $request)
    {
        // $tudent = new Student();
        // $student = $student::find($request->input('id'));
        // $student->student_name = $request->input('student_name');
        // $student->father_name = $request->input('father_name');
        // $student->mother_name = $request->input('mother_name');
        // $student->guardian_name = $request->input('guardian_name');
        // $student->relation_to_gurdian = $request->input('relation_to_gurdian');
        // $student->dob = $request->input('dob');
        // $student->sex = $request->input('sex');
        // $student->address = $request->input('address');
        // $student->city = $request->input('city');
        // $student->district = $request->input('district');
        // $student->state = $request->input('state');
        // $student->pin= $request->input('relation_');
        // $state->relation_to_gurdian = $request->input('relation_to_gurdian');
        // $state->relation_to_gurdian = $request->input('relation_to_gurdian');
        // $state->relation_to_gurdian = $request->input('relation_to_gurdian');
        // $state->save();
        // return response()->json(['success'=>1,'data'=>$state], 200,[],JSON_NUMERIC_CHECK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    //


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}

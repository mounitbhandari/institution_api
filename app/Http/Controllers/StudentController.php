<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\StudentResource;

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
       $student= new Student();
       $student ->student_name = $request->input('studentName');
       $state->father_name= $request->input('fatherName');
       $state->mother_name= $request->input('motherName');
       $state->guardian_name= $request->input('guardianName');
       $state->relation_to_gurdian= $request->input('relationToGurdian');
       $state->dob= $request->input('dob');
       $state->sex= $request->input('sex');
       $state->address= $request->input('address');
       $state->city= $request->input('city');
       $state->distric= $request->input('distric');
       $state->state= $request->input('state');
       $state->pin= $request->input('pin');
       $state->gurdian_contact_number= $request->input('gurdianContactNumber');
       $state->whatsapp_number= $request->input('whatsappNumber');
       $state->email_id= $request->input('email');
       $state->qualification= $request->input('qualification');
        $state->save();

        return response()->json(['success'=>1,'data'=>$state], 200,[],JSON_NUMERIC_CHECK);
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
    public function edit(Student $student)
    {
        //
    }

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

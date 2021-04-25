<?php

namespace App\Http\Controllers;

use App\Models\CustomVoucher;
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
           //$temp_date = explode("-",$inputTransactionMaster->transaction_date);
           $accounting_year="";
//           if($temp_date[1]>3){
//               $x = $temp_date[0]%100;
//               $accounting_year = $x*100 + ($x+1);
//           }else{
//               $x = $temp_date[0]%100;
//               $accounting_year =($x-1)*100+$x;
//           }
           $accounting_year=2021;
           $customVoucher=CustomVoucher::where('voucher_name','=',"student")->where('accounting_year',"=",$accounting_year)->first();
           if($customVoucher) {
               //already exist
               $customVoucher->last_counter = $customVoucher->last_counter + 1;
               $customVoucher->save();
           }else{
               //fresh entry
               $customVoucher= new CustomVoucher();
               $customVoucher->voucher_name="student";
               $customVoucher->accounting_year= $accounting_year;
               $customVoucher->last_counter=1;
               $customVoucher->delimiter='-';
               $customVoucher->prefix='CODER';
               $customVoucher->save();
           }
           //adding Zeros before number
           $counter = str_pad($customVoucher->last_counter,5,"0",STR_PAD_LEFT);
           //creating sale bill number
           $episode_id = $customVoucher->prefix.'-'.$counter."-".$accounting_year;

           // if any record is failed then whole entry will be rolled back
           //try portion execute the commands and catch execute when error.
            $student= new Student();
            $student->episode_id =$episode_id;
            $student ->student_name = $request->input('studentName');
            $student->father_name= $request->input('fatherName');
            $student->mother_name= $request->input('motherName');
            $student->guardian_name= $request->input('guardianName');
            $student->relation_to_guardian= $request->input('relationTgGuardian');
            $student->dob= $request->input('dob');
            $student->sex= $request->input('sex');
            $student->address= $request->input('address');
            $student->city= $request->input('city');
            $student->district= $request->input('district');
            $student->state_id= $request->input('stateId');
            $student->pin= $request->input('pin');
            $student->guardian_contact_number= $request->input('guardianContactNumber');
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

    public function update(Request $request)
    {
        $student = new Student();

        $student = Student::find($request->input('studentId'));
        $student->episode_id = $request->input('episodeId');
        $student->student_name = $request->input('studentName');
        $student->father_name = $request->input('fatherName');
        $student->mother_name = $request->input('motherName');
        $student->guardian_name = $request->input('guardianName');
        $student->relation_to_guardian = $request->input('relationTgGuardian');
        $student->dob = $request->input('dob');
        $student->sex = $request->input('sex');
        $student->address = $request->input('address');
        $student->city = $request->input('city');
        $student->district = $request->input('district');
        $student->state_id= $request->input('stateId');
        $student->pin= $request->input('pin');
        $student->guardian_contact_number = $request->input('guardianContactNumber');
        $student->whatsapp_number = $request->input('whatsappNumber');
        $student->email_id = $request->input('email');
        $student->qualification= $request->input('qualification');
        return response()->json(['success'=>1,'data'=>new StudentResource($student)], 200,[],JSON_NUMERIC_CHECK);
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

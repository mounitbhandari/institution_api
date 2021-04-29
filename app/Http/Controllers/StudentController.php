<?php

namespace App\Http\Controllers;

use App\Models\CustomVoucher;
use App\Models\Ledger as Student;
use App\Models\LedgerGroup;
use App\Models\StudentCourseRegistration;
use Carbon\Carbon;
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
    public function index()
    {
      $students= Student::where('is_student','=',1)->get();
      return response()->json(['success'=>1,'data'=> StudentResource::collection($students)], 200,[],JSON_NUMERIC_CHECK);
    }
    public function get_all_course_registered_students(){
        $data = Student::has('course_registered')->where('is_student','=',1)->get();
        return response()->json(['success'=>1,'data'=>$data], 200,[],JSON_NUMERIC_CHECK);
    }
    public function get_all_non_course_registered_students(){
        $data = Student::doesnthave('course_registered')->where('is_student','=',1)->get();
        return response()->json(['success'=>1,'data'=>$data], 200,[],JSON_NUMERIC_CHECK);
    }
    /*
     * যে সব স্টুডেন্টের কোর্স বর্তমানে চলছে তাদের দেখার জন্য আমি এটা ব্যবহার করেছি। course_registered এই কি ওয়ার্ডটি আমি Ledger Model এ বানিয়ে এসেছি।
    */
    public function get_all_current_course_registered_students(){
        /*
         * আমরা যে eloquent query করি তা অনেক সময় আমরা বুঝতে পারি না তা SQL এ কিভাবে দেখতে হয়, তা বোঝার জন্য আমার
         * কোড কে এক্সিকিউট না করে তার query কে পেতে পারি, যদিও কাজের ক্ষেত্রে এর কোন প্রয়োজন নেই।
         * */
        $query = Student::whereHas('course_registered', function($q){
            $q->where('is_completed', '=', 0);
        })->where('is_student','=',1);
        $query_string=get_sql_with_bindings($query);

        $data = Student::whereHas('course_registered', function($q){
            $q->where('is_completed', '=', 0);
        })->where('is_student','=',1)->get();
        return response()->json(['success'=>1,'data'=>$data,'sql'=>$query_string], 200,[],JSON_NUMERIC_CHECK);
    }

    public function get_student_by_id($id){
        try {
//            $student = Student::findOrFail($id);
            $student = Student::where('id', $id)->where('is_student','=',1)->firstOrFail();
            return response()->json(['success'=>true,'data'=>new StudentResource($student)], 200,[],JSON_NUMERIC_CHECK);
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'data'=>null], 404,[],JSON_NUMERIC_CHECK);
        }
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'studentName' => 'required|max:255|unique:ledgers,ledger_name',
            'stateId' => 'required|exists:states,id'
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>0,'data'=>null,'error'=>$validator->messages()], 406,[],JSON_NUMERIC_CHECK);
        }
        if($request->has('entryDate')) {
            $entryDate = $request->input('entryDate');
        }else{
            $entryDate=Carbon::now()->format('Y-m-d');
        }
        DB::beginTransaction();

       try{
           $temp_date = explode("-",$entryDate);
           $accounting_year="";
           if($temp_date[1]>3){
               $x = $temp_date[0]%100;
               $accounting_year = $x*100 + ($x+1);
           }else{
               $x = $temp_date[0]%100;
               $accounting_year =($x-1)*100+$x;
           }
           //$accounting_year=2021;
           $voucher="student";
           $customVoucher=CustomVoucher::where('voucher_name','=',$voucher)->where('accounting_year',"=",$accounting_year)->first();
           if($customVoucher) {
               //already exist
               $customVoucher->last_counter = $customVoucher->last_counter + 1;
               $customVoucher->save();
           }else{
               //fresh entry
               $customVoucher= new CustomVoucher();
               $customVoucher->voucher_name=$voucher;
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
            $student->ledger_group_id = 16;
            $student->is_student=1;

            $student ->ledger_name = $request->input('studentName');
            $student ->billing_name = $request->input('billingName');
            $student->episode_id =$episode_id;
            $student->father_name= $request->input('fatherName');
            $student->mother_name= $request->input('motherName');
            $student->guardian_name= $request->input('guardianName');
            $student->relation_to_guardian= $request->input('relationTogGuardian');
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
            $student->entry_date= $entryDate;
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
        $ledger_id = $request->input('studentId');
        $validator = Validator::make($request->all(),[
            'studentName' => 'required|max:255|unique:ledgers,ledger_name,'.$ledger_id,
            'stateId' => 'required|exists:states,id'
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>0,'data'=>null,'error'=>$validator->messages()], 406,[],JSON_NUMERIC_CHECK);
        }

        $student = new Student();
        $student->ledger_group_id = 16;
        $student->is_student=1;

        $student = Student::find($request->input('studentId'));
        $student->episode_id = $request->input('episodeId');
        $student->ledger_name = $request->input('studentName');
        $student->billing_name = $request->input('billingName');
        $student->father_name = $request->input('fatherName');
        $student->mother_name = $request->input('motherName');
        $student->guardian_name = $request->input('guardianName');
        $student->relation_to_guardian = $request->input('relationTogGuardian');
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
        $student->save();
        return response()->json(['success'=>1,'data'=>new StudentResource($student)], 200,[],JSON_NUMERIC_CHECK);

    }
    public function delete($id)
    {
        $student = Student::find($id);
        if(!empty($student)){
            $result = $student->delete();
        }else{
            $result = false;
        }
        return response()->json(['success'=>$result,'id'=>$id], 200);
    }

    public function show(Student $student)
    {
        //
    }

    public function destroy(Student $student)
    {
        //
    }


}

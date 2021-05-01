<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CustomVoucher;
use App\Models\StudentCourseRegistration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\RequiredIf;

class StudentCourseRegistrationController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {

        //validation

        /*
         * public function rules()
            {
                return [
                    'sale_price' => [
                        new RequiredIf($this->list_type == 'For Sale'),
                        'string',
                        ...
                    ]
                ];
            }
         * */





        $validator = Validator::make($request->all(), [
            'courseId' => 'bail|required|exists:courses,id',
            'studentId' => 'bail|required|exists:ledgers,id',
            'baseFee' => 'bail|required|integer|gt:0',
            'discountAllowed'=>'lt:baseFee',
            'effectiveDate' => 'bail|required|date_format:Y-m-d',
//            'durationTypeId'=> [new RequiredIf('actualCourseDuration= 0')]
        ],[
            'courseId.required'=> 'Course ID is required', // custom message
            'courseId.exists'=> 'This course ID does not exists', // custom message
            'studentId.required'=> 'You have to input student ID', // custom message
            'studentId.exists'=> 'This student does not exists', // custom message
            'discountAllowed.lt'=> 'Discount should be lower than the Base Price' // custom message
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>0,'data'=>null,'error'=>$validator->messages()], 406,[],JSON_NUMERIC_CHECK);
        }

        $courseId = $request->input('courseId');
        $courseCode = Course::findOrFail($courseId)->course_code;
        if($request->has('joiningDate')) {
            $joiningDate = $request->input('joiningDate');
        }else{
            $joiningDate=Carbon::now()->format('Y-m-d');
        }
        DB::beginTransaction();

        try{
            $temp_date = explode("-",$joiningDate);
            if($temp_date[1]>3){
                $x = $temp_date[0]%100;
                $accounting_year = $x*100 + ($x+1);
            }else{
                $x = $temp_date[0]%100;
                $accounting_year =($x-1)*100+$x;
            }
            $voucher="StudentCourseRegistration";
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
            $counter = str_pad($customVoucher->last_counter,3,"0",STR_PAD_LEFT);
            //creating reference number
            $reference_number = $courseCode.''.$counter."@".$accounting_year;


            // if any record is failed then whole entry will be rolled back
            //try portion execute the commands and catch execute when error.
            $courseRegistration= new StudentCourseRegistration();
            $courseRegistration->reference_number = $reference_number;
            $courseRegistration->ledger_id = $request->input('studentId');
            $courseRegistration->course_id= $request->input('courseId');
            $courseRegistration->base_fee= $request->input('baseFee');
            $courseRegistration->discount_allowed= $request->input('discountAllowed');
            $courseRegistration->joining_date= $joiningDate;
            $courseRegistration->effective_date= $request->input('effectiveDate');
            $courseRegistration->is_started= $request->input('isStarted');
            $courseRegistration->save();
            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['success'=>0,'exception'=>$e->getMessage()], 500);
        }

        return response()->json(['success'=>1,'data'=> $courseRegistration], 200,[],JSON_NUMERIC_CHECK);
    }
    public function update(Request $request, StudentCourseRegistration $studentCourseRegistration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentCourseRegistration  $studentCourseRegistration
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentCourseRegistration $studentCourseRegistration)
    {
        //
    }
}

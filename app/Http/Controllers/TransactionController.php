<?php

namespace App\Http\Controllers;

use App\Models\Ledger as Student;
use App\Models\StudentCourseRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function save_fees(Request $request)
    {
        //validation
        $rules = array(
            'transactionDate' => 'bail|required|date_format:Y-m-d',
            'studentCourseRegistrationId' => ['bail','required',
                function($attribute, $value, $fail){
                    $StudentCourseRegistration=StudentCourseRegistration::where('id', $value)->where('is_completed','=',0)->first();
                    if(!$StudentCourseRegistration){
                        $fail($value.' is not a valid Course Registration Number');
                    }
                }],
        );
        $messages = array(

        );

        $validator = Validator::make($request->all(),$rules,$messages );
        if ($validator->fails()) {
            return response()->json(['success'=>0,'data'=>null,'error'=>$validator->messages()], 406,[],JSON_NUMERIC_CHECK);
        }

        return response()->json(['success'=>2,'data'=>null,'error'=>'no error'], 200,[],JSON_NUMERIC_CHECK);
    }
}

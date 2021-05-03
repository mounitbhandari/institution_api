<?php

namespace App\Http\Controllers;

use App\Models\CustomVoucher;
use App\Models\StudentCourseRegistration;
use App\Models\TransactionDetail;
use App\Models\TransactionMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function save_fees(Request $request)
    {
        $input=($request->json()->all());

        $validator = Validator::make($input,[
            'transactionMaster' => 'required',
            'transactionDetails' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['success'=>0,'data'=>null,'error'=>$validator->messages()], 200,[],JSON_NUMERIC_CHECK);
        }

        $input=($request->json()->all());
        $input_transaction_master=(object)($input['transactionMaster']);
        $input_transaction_details=($input['transactionDetails']);
//        return response()->json(['success'=>0,'data'=>$input], 200,[],JSON_NUMERIC_CHECK);
        //validation
        $rules = array(
            'userId'=>'required|exists:users,id',
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
            'transactionDate.required'=>'Transaction Date is required',
            'transactionDate.date_format'=>'Date format should be yyyy-mm-dd',
        );

        $validator = Validator::make($input['transactionMaster'],$rules,$messages );


        if ($validator->fails()) {
            return response()->json(['position'=>1,'success'=>0,'data'=>null,'error'=>$validator->messages()], 406,[],JSON_NUMERIC_CHECK);
        }

        DB::beginTransaction();
        try{
            $result_array=array();
            $accounting_year = get_accounting_year($request->input('transactionDate'));
            $voucher="Fees Charged";
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
                $customVoucher->prefix='FEES';
                $customVoucher->save();
            }
            //adding Zeros before number
            $counter = str_pad($customVoucher->last_counter,5,"0",STR_PAD_LEFT);

            //creating sale bill number
            $transaction_number = $customVoucher->prefix.'-'.$counter."-".$accounting_year;
            $result_array['transaction_number']=$transaction_number;

            //saving transaction master
            $transaction_master= new TransactionMaster();
            $transaction_master->voucher_type_id = 8; // 8 is the voucher_type_id in voucher_types table for Fees Charged Journal Voucher
            $transaction_master->transaction_number = $transaction_number;
            $transaction_master->transaction_date = $request->input('transactionDate');
            $transaction_master->comment = $request->input('comment');
            $transaction_master->save();
            $result_array['transaction_master']=$transaction_master;
//            foreach($transaction_details as $transaction_detail){
//                $td = new TransactionDetail();
//                $td->purchase_master_id = $purchaseMaster->id;
//                $td->save();
//            }
            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['success'=>0,'exception'=>$e->getMessage()], 500);
        }

        return response()->json(['success'=>2,'data'=>null,'data'=>$result_array], 200,[],JSON_NUMERIC_CHECK);
    }
}

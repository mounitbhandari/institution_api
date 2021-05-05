<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionMasterResource;
use App\Models\CustomVoucher;
use App\Models\Ledger;
use App\Models\StudentCourseRegistration;
use App\Models\TransactionDetail;
use App\Models\TransactionMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{

    public function get_all_transactions(){
        $transactions = TransactionMaster::get();
        return response()->json(['success'=>0,'data'=>TransactionMasterResource::collection($transactions)], 200,[],JSON_NUMERIC_CHECK);
    }
    //get fees charged transactions
    public function get_all_fees_charged_transactions(){
        $transactions = TransactionMaster::where('voucher_type_id',9)->get();
        return response()->json(['success'=>0,'data'=>TransactionMasterResource::collection($transactions)], 200,[],JSON_NUMERIC_CHECK);
    }

    public function get_total_dues_by_student_id($id){
        $debit = TransactionDetail::where('ledger_id',$id)->where('transaction_type_id',1)->sum('amount');
        $credit = TransactionDetail::where('ledger_id',$id)->where('transaction_type_id',2)->sum('amount');
        return response()->json(['success'=>0,'data'=>$debit-$credit], 200,[],JSON_NUMERIC_CHECK);
    }
    public function get_student_due_by_student_course_registration_id($id){
        //getting student course registration id
        $studentCourseRegistrationId = StudentCourseRegistration::where('ledger_id',$id)->first()->id;
        //transaction masters ids related to course registration
        $transaction_master_ids = TransactionMaster::where('student_course_registration_id',$studentCourseRegistrationId)->pluck('id');

        $debit = TransactionDetail::whereIn('transaction_master_id',$transaction_master_ids)->where('transaction_type_id',1)->where('ledger_id',$id)->sum('amount');
        $credit = TransactionDetail::whereIn('transaction_master_id',$transaction_master_ids)->where('transaction_type_id',2)->where('ledger_id',$id)->sum('amount');
        $result = $debit - $credit;
        return response()->json(['success'=>0,'data'=>$result], 200,[],JSON_NUMERIC_CHECK);
    }

    //saving fees charging to student
    public function save_fees_charge(Request $request)
    {
        $input=($request->json()->all());

        $validator = Validator::make($input,[
            'transactionMaster' => 'required',
            'transactionDetails' => ['required',function($attribute, $value, $fail){
                $dr=0;
                $cr=0;

                foreach ($value as $v ){

                    /*
                     * This is a fees charging transaction, hence only a student can be debited
                     * */
                    if($v['transactionTypeId']==1){
                        $student = Ledger::find($v['ledgerId']);
                        if(!$student){
                            return $fail($v['ledgerId']." this ledger does not exist");
                        }
                        if($student->is_student==0){
                            return $fail("Only student can be Debited");
                        }
                    }
                    /*
                     * This is a fees charging transaction, hence only fees ca be credited
                     * */

                    if($v['transactionTypeId']==2){
                        $ledger = Ledger::find($v['ledgerId']);
                        if(!$ledger){
                            return $fail($v['ledgerId']." this ledger does not exist");
                        }
                        if($ledger->ledger_group_id!=6){
                            return $fail("This is not belongs to income ledger like fees");
                        }
                    }


                    if(!($v['transactionTypeId']==1 || $v['transactionTypeId']==2)){
                        return $fail("Transaction type id is incorrect");
                    }
                    if($v['transactionTypeId']==1){
                        $dr=$dr+$v['amount'];
                    }
                    if($v['transactionTypeId']==2){
                        $cr=$cr+$v['amount'];
                    }
                }

                if($dr!=$cr){
                    $fail("As per accounting rule Debit({$dr})  and Credit({$cr}) should be same");
                }


            }],
        ]);
        if($validator->fails()){
            return response()->json(['success'=>0,'data'=>null,'error'=>$validator->messages()], 200,[],JSON_NUMERIC_CHECK);
        }

        $input=($request->json()->all());
        $input_transaction_master=(object)($input['transactionMaster']);
        $input_transaction_details=($input['transactionDetails']);

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

        //details verification
        //validation
        $rules = array(
            "*.transactionTypeId"=>'required|in:1,2'
        );
        $validator = Validator::make($input['transactionDetails'],$rules,$messages );
        if ($validator->fails()) {
            return response()->json(['position'=>1,'success'=>0,'data'=>null,'error'=>$validator->messages()], 406,[],JSON_NUMERIC_CHECK);
        }
        DB::beginTransaction();
        try{
            $result_array=array();
            $accounting_year = get_accounting_year($input_transaction_master->transactionDate);
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
            $transaction_master->voucher_type_id = 9; // 9 is the voucher_type_id in voucher_types table for Fees Charged Journal Voucher
            $transaction_master->transaction_number = $transaction_number;
            $transaction_master->transaction_date = $input_transaction_master->transactionDate;
            $transaction_master->student_course_registration_id = $input_transaction_master->studentCourseRegistrationId;
            $transaction_master->comment = $input_transaction_master->comment;
            $transaction_master->save();
            $result_array['transaction_master']=$transaction_master;
            $transaction_details=array();
            foreach($input_transaction_details as $transaction_detail){
                $detail = (object)$transaction_detail;
                $td = new TransactionDetail();
                $td->transaction_master_id = $transaction_master->id;
                $td->ledger_id = $detail->ledgerId;
                $td->transaction_type_id = $detail->transactionTypeId;
                $td->amount = $detail->amount;
                $td->save();
                $transaction_details[]=$td;
            }
            $result_array['transaction_details']=$transaction_details;
            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['success'=>0,'exception'=>$e->getMessage()], 500);
        }

        return response()->json(['success'=>2,'data'=>new TransactionMasterResource($result_array['transaction_master'])], 200,[],JSON_NUMERIC_CHECK);
    }
    //fees received
    public function save_fees_received(Request $request)
    {
        $input=($request->json()->all());

        $validator = Validator::make($input,[
            'transactionMaster' => 'required',
            'transactionDetails' => ['required',function($attribute, $value, $fail){
                $dr=0;
                $cr=0;
                foreach ($value as $v ){
                    //if transaction type id is incorrect
                    if(!($v['transactionTypeId']==1 || $v['transactionTypeId']==2)){
                        return $fail("Transaction type id is incorrect");
                    }

                    //checking debit and credit equality
                    if($v['transactionTypeId']==1){
                        $dr=$dr+$v['amount'];
                    }
                    if($v['transactionTypeId']==2){
                        $cr=$cr+$v['amount'];
                    }
                }
                //if debit and credit are not equal will through error
                if($dr!=$cr){
                    $fail("As per accounting rule Debit({$dr})  and Credit({$cr}) should be same");
                }
            }],
        ]);
        if($validator->fails()){
            return response()->json(['success'=>0,'data'=>null,'error'=>$validator->messages()], 200,[],JSON_NUMERIC_CHECK);
        }

        $input=($request->json()->all());
        $input_transaction_master=(object)($input['transactionMaster']);
        $input_transaction_details=($input['transactionDetails']);

        //validation for transaction master
        $rules = array(
            'userId'=>'required|exists:users,id',
            'transactionDate' => 'bail|required|date_format:Y-m-d',
            'referenceTransactionMasterId'=>['required','exists:transaction_masters,id',
                function($attribute, $value, $fail){
                    $TM = TransactionMaster::find($value);
                    if(!$TM){
                        return $fail($value.' no such transactions exists');
                    }
                    if($TM->voucher_type_id!=9){
                        return $fail($value.' this is not a Fees Entry');
                    }
                }]
        );
        $messages = array(
            'transactionDate.required'=>'Transaction Date is required',
            'transactionDate.date_format'=>'Date format should be yyyy-mm-dd',
        );

        $validator = Validator::make($input['transactionMaster'],$rules,$messages );


        if ($validator->fails()) {
            return response()->json(['position'=>1,'success'=>0,'data'=>null,'error'=>$validator->messages()], 406,[],JSON_NUMERIC_CHECK);
        }

        //details verification
        //validation
        $rules = array(
            "*.transactionTypeId"=>["required","in:1,2"]
        );
        $validator = Validator::make($input['transactionDetails'],$rules,$messages );
        if ($validator->fails()) {
            return response()->json(['position'=>1,'success'=>0,'data'=>null,'error'=>$validator->messages()], 406,[],JSON_NUMERIC_CHECK);
        }
        DB::beginTransaction();
        try{
            $result_array=array();
            $accounting_year = get_accounting_year($input_transaction_master->transactionDate);
            $voucher="Fees Received";
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
                $customVoucher->prefix='RPT';
                $customVoucher->save();
            }
            //adding Zeros before number
            $counter = str_pad($customVoucher->last_counter,5,"0",STR_PAD_LEFT);

            //creating sale bill number
            $transaction_number = $customVoucher->prefix.'-'.$counter."-".$accounting_year;
            $result_array['transaction_number']=$transaction_number;

            //saving transaction master
            $transaction_master= new TransactionMaster();
            $transaction_master->voucher_type_id = 4; // 4 is the voucher_type_id in voucher_types table for Receipt voucher
            $transaction_master->transaction_number = $transaction_number;
            $transaction_master->transaction_date = $input_transaction_master->transactionDate;

            $transaction_master->reference_transaction_master_id = $input_transaction_master->referenceTransactionMasterId;
            $transaction_master->comment = $input_transaction_master->comment;
            $transaction_master->save();
            $result_array['transaction_master']=$transaction_master;
            $transaction_details=array();
            foreach($input_transaction_details as $transaction_detail){
                $detail = (object)$transaction_detail;
                $td = new TransactionDetail();
                $td->transaction_master_id = $transaction_master->id;
                $td->ledger_id = $detail->ledgerId;
                $td->transaction_type_id = $detail->transactionTypeId;
                $td->amount = $detail->amount;
                $td->save();
                $transaction_details[]=$td;
            }
            $result_array['transaction_details']=$transaction_details;
            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['success'=>0,'exception'=>$e->getMessage()], 500);
        }

        return response()->json(['success'=>2,'data'=>new TransactionMasterResource($result_array['transaction_master'])], 200,[],JSON_NUMERIC_CHECK);
    }
}

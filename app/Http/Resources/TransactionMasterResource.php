<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed voucher_type_id
 * @property mixed transaction_number
 * @property mixed transaction_date
 * @property mixed comment
 * @property mixed id
 * @property mixed voucher_type
 * @property mixed transaction_details
 */
class TransactionMasterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
           "transactionNumber" =>$this->transaction_number,
           "transactionDate"=>$this->transaction_date,
           "comment"=>$this->comment,
           "transactionMasterId"=>$this->id,
           "voucherType"=> new VoucherTypeResource($this->voucher_type),
           "transactionDetails"=>TransactionDetailResource::collection($this->transaction_details)
        ];
    }
}

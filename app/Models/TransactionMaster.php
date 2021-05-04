<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMaster extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = [
        "inforcc","created_at","updated_at"
    ];
    /**
     * @var int|mixed
     */
    private $voucher_type_id;
    /**
     * @var mixed|string
     */
    private $transaction_number;
    /**
     * @var mixed
     */
    private $transaction_date;
    /**
     * @var mixed
     */
    private $comment;
    /**
     * @var mixed
     */
    private $reference_transaction_master_id;


    public function voucher_type()
    {
        return $this->belongsTo(VoucherType::class,'voucher_type_id');
    }
    public function transaction_details() {
        return $this->hasMany(TransactionDetail::class, 'transaction_master_id');
    }
    public function reference_transaction() {
        return $this->hasMany(TransactionMaster::class, 'reference_transaction_master_id');
    }
    public function parent_transaction() {
        return $this->belongsTo(TransactionMaster::class, 'reference_transaction_master_id');
    }
}

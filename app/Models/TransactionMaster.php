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
}

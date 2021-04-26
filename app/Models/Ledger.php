<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;

    /**
     * @var mixed|string
     */
    private $episode_id;
    /**
     * @var mixed
     */
    private $student_name;
    /**
     * @var mixed
     */
    private $father_name;
    /**
     * @var mixed
     */
    private $mother_name;
    /**
     * @var mixed
     */
    private $guardian_name;
    /**
     * @var mixed
     */
    private $relation_to_guardian;
    /**
     * @var mixed
     */
    private $dob;
    /**
     * @var mixed
     */
    private $sex;
    /**
     * @var mixed
     */
    private $address;
    /**
     * @var mixed
     */
    private $city;
    /**
     * @var mixed
     */
    private $ledger_name;
    /**
     * @var mixed
     */
    private $billing_name;
    /**
     * @var int|mixed
     */
    private $ledger_group_id;
    /**
     * @var mixed
     */
    private $entry_date;
    /**
     * @var mixed
     */
    private $district;
    /**
     * @var mixed
     */
    private $state_id;
    /**
     * @var mixed
     */
    private $pin;
    /**
     * @var mixed
     */
    private $guardian_contact_number;
    /**
     * @var mixed
     */
    private $whatsapp_number;
    /**
     * @var mixed
     */
    private $email_id;
    /**
     * @var mixed
     */
    private $qualification;
    /**
     * @var int|mixed
     */
    private $is_student;
}

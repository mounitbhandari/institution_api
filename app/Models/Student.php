<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = [
        "inforce","created_at","updated_at"
    ];

    /**
     * @var mixed
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
    private $relation_to_gurdian;
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
    private $district;
    /**
     * @var mixed
     */
    private $state;
    /**
     * @var mixed
     */
    private $pin;
    /**
     * @var mixed
     */
    private $gurdian_contact_number;
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
}

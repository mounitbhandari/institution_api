<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed description
 * @property mixed course_duration
 * @property mixed full_name
 * @property mixed short_name
 */
class Course extends Model
{
    use HasFactory;

    /**
     * @var mixed
     */
    private $course_code;
}

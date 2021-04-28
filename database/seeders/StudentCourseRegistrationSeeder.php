<?php

namespace Database\Seeders;

use App\Models\StudentCourseRegistration;
use Illuminate\Database\Seeder;

class StudentCourseRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentCourseRegistration::create(['ledger_id'=>1,'course_id'=>1,'base_fee'=>3000,'discount_allowed'=>1200,'joining_date'=>'2021-04-28']);
        StudentCourseRegistration::create(['ledger_id'=>1,'course_id'=>2,'base_fee'=>6900,'discount_allowed'=>3200,'joining_date'=>'2021-04-28']);
        StudentCourseRegistration::create(['ledger_id'=>1,'course_id'=>3,'base_fee'=>6900,'discount_allowed'=>5200,'joining_date'=>'2021-04-28']);
        StudentCourseRegistration::create(['ledger_id'=>1,'course_id'=>4,'base_fee'=>6900,'discount_allowed'=>5200,'joining_date'=>'2021-04-28','is_completed'=>true]);
    }
}

<?php

namespace Database\Seeders;




use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserType;
use App\Models\Student;







class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //person_types table data
        UserType::create(['user_type_name' => 'Owner']);
        UserType::create(['user_type_name' => 'Manager']);
        UserType::create(['user_type_name' => 'Manager Sales']);
        UserType::create(['user_type_name' => 'Manager Accounts']);
        UserType::create(['user_type_name' => 'Office Staff']);
        UserType::create(['user_type_name' => 'Worker']);
        UserType::create(['user_type_name' => 'Developer']);
        UserType::create(['user_type_name' => 'Customer']);

        User::create(['user_name'=>'Arindam Biswas','mobile1'=>'9836444999','mobile2'=>'100','email'=>'arindam','password'=>"81dc9bdb52d04dc20036dbd8313ed055",'user_type_id'=>1]);

        Student::create([
            'student_name' => 'Bimal Paul',
            'father_name' => 'Atanu Paul',
            'mother_name' => 'Aroti Paul',
            'guardian_name' => 'Atanu Paul',
            'relation_to_gurdian' => 'Father',
            'dob' => '1999-08-14',
            'sex' => 'Male',
            'address' => '56/7,Rabindrapally',
            'city' => 'Barrackpore',
            'distric' => 'North 24 Parganas',
            'state' => 'West Bengal',
            'pin' => '700122',
            'gurdian_contact_number' => '9832700122',
            'whatsapp_number' => '7985241065',
            'email_id' => 'bimalpaul@gmail.com',
            'qualification' => 'HS'

        ]);
        Student::create([
            'student_name' => 'Riya Das',
            'father_name' => 'Sourav Das',
            'mother_name' => 'Kakali Das',
            'guardian_name' => 'Kakali Das',
            'relation_to_gurdian' => 'mother',
            'dob' => '2000-05-15',
            'sex' => 'female',
            'address' => '13/c,R.N.Tagore Road',
            'city' => 'Kolkata',
            'distric' => 'Kolkata',
            'state' => 'West Bengal',
            'pin' => '70010',
            'gurdian_contact_number' => '9835700182',
            'whatsapp_number' => '9903652417',
            'email_id' => 'riya99@gmail.com',
            'qualification' => 'HS'

        ]);
        Student::create([
            'student_name' => 'Suchismita Das',
            'father_name' => 'Sujan Das',
            'mother_name' => 'Kakali Das',
            'guardian_name' => 'piya Das',
            'relation_to_gurdian' => 'mother',
            'dob' => '2000-08-09',
            'sex' => 'female',
            'address' => '39/b,G.T.Road',
            'city' => 'Kolkata',
            'distric' => 'Howrah',
            'state' => 'West Bengal',
            'pin' => '70010',
            'gurdian_contact_number' => '9835700182',
            'whatsapp_number' => '9903652417',
            'email_id' => 'riya99@gmail.com',
            'qualification' => 'HS'

        ]);
        Student::create([
            'student_name' => 'Raj Ghosh',
            'father_name' => 'Ratan Ghosh',
            'mother_name' => 'Mita Ghosh',
            'guardian_name' => 'Mita Ghosh',
            'relation_to_gurdian' => 'mother',
            'dob' => '2001-11-21',
            'sex' => 'female',
            'address' => '10/b R.Sen Road',
            'city' => 'Siliguri',
            'distric' => 'Siliguri',
            'state' => 'West Bengal',
            'pin' => '734001',
            'gurdian_contact_number' => '9835700182',
            'whatsapp_number' => '9903652417',
            'email_id' => 'rajghosh@gmail.com',
            'qualification' => 'HS'

        ]);
        Student::create([
            'student_name' => 'Piyali Sen',
            'father_name' => 'Raju Sen',
            'mother_name' => 'Putul Sen',
            'guardian_name' => 'Putul Sen',
            'relation_to_gurdian' => 'mother',
            'dob' => '2000-08-27',
            'sex' => 'female',
            'address' => '13/c,Rabindra Sarani',
            'city' => 'Kolkata',
            'distric' => 'Kolkata',
            'state' => 'West Bengal',
            'pin' => '700008',
            'gurdian_contact_number' => '9805741496',
            'whatsapp_number' => '9732568412',
            'email_id' => 'piyali45@gmail.com',
            'qualification' => 'HS'

        ]);


       
    }
}

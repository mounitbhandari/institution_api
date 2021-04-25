<?php

namespace Database\Seeders;




use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserType;
use App\Models\Student;
use App\Models\State;







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


        User::create(['user_name'=>'Arindam Biswas','mobile1'=>'9836444999','mobile2'=>'100'
        ,'email'=>'arindam','password'=>"81dc9bdb52d04dc20036dbd8313ed055",'user_type_id'=>1]);
        //storing state
        State::insert([
            ['state_code'=>0,'state_name'=>'Not applicable'],
            ['state_code'=>1,'state_name'=>'Jammu & Kashmir'],
            ['state_code'=>2,'state_name'=>'Himachal Pradesh'],
            ['state_code'=>3,'state_name'=>'Punjab'],
            ['state_code'=>4,'state_name'=>'Chandigarh'],
            ['state_code'=>5,'state_name'=>'Uttranchal'],
            ['state_code'=>6,'state_name'=>'Haryana'],
            ['state_code'=>7,'state_name'=>'Delhi'],
            ['state_code'=>8,'state_name'=>'Rajasthan'],
            ['state_code'=>9,'state_name'=>'Uttar Pradesh'],
            ['state_code'=>10,'state_name'=>'Bihar'],
            ['state_code'=>11,'state_name'=>'Sikkim'],
            ['state_code'=>12,'state_name'=>'Arunachal Pradesh'],
            ['state_code'=>13,'state_name'=>'Nagaland'],
            ['state_code'=>14,'state_name'=>'Manipur'],
            ['state_code'=>15,'state_name'=>'Mizoram'],
            ['state_code'=>16,'state_name'=>'Tripura'],
            ['state_code'=>17,'state_name'=>'Meghalaya'],
            ['state_code'=>18,'state_name'=>'Assam'],
            ['state_code'=>19,'state_name'=>'West Bengal'],
            ['state_code'=>20,'state_name'=>'Jharkhand'],
            ['state_code'=>21,'state_name'=>'Odisha (Formerly Orissa'],
            ['state_code'=>22,'state_name'=>'Chhattisgarh'],
            ['state_code'=>23,'state_name'=>'Madhya Pradesh'],
            ['state_code'=>24,'state_name'=>'Gujarat'],
            ['state_code'=>25,'state_name'=>'Daman & Diu'],
            ['state_code'=>26,'state_name'=>'Dadra & Nagar Haveli'],
            ['state_code'=>27,'state_name'=>'Maharashtra'],
            ['state_code'=>28,'state_name'=>'Andhra Pradesh'],
            ['state_code'=>29,'state_name'=>'Karnataka'],
            ['state_code'=>30,'state_name'=>'Goa'],
            ['state_code'=>31,'state_name'=>'Lakshdweep'],
            ['state_code'=>32,'state_name'=>'Kerala'],
            ['state_code'=>33,'state_name'=>'Tamil Nadu'],
            ['state_code'=>34,'state_name'=>'Pondicherry'],
            ['state_code'=>35,'state_name'=>'Andaman & Nicobar Islands'],
            ['state_code'=>36,'state_name'=>'Telangana']
        ]);


        Student::create([
            'episode_id' =>'a1',
            'student_name' => 'Bimal Paul',
            'father_name' => 'Atanu Paul',
            'mother_name' => 'Aroti Paul',
            'guardian_name' => 'Atanu Paul',
            'relation_to_guardian' => 'Father',
            'dob' => '1999-08-14',
            'sex' => 'M',
            'address' => '56/7,Rabindrapally',
            'city' => 'Barrackpore',
            'district' => 'North 24 Parganas',
            'state_id' => 22,
            'pin' => '700122',
            'guardian_contact_number' => '9832700122',
            'whatsapp_number' => '7985241065',
            'email_id' => 'bimalpaul@gmail.com',
            'qualification' => 'HS'
        ]);
        Student::create([
            'episode_id' =>'a2',
            'student_name' => 'Riya Das',
            'father_name' => 'Sourav Das',
            'mother_name' => 'Kakali Das',
            'guardian_name' => 'Kakali Das',
            'relation_to_guardian' => 'mother',
            'dob' => '2000-05-15',
            'sex' => 'F',
            'address' => '13/c,R.N.Tagore Road',
            'city' => 'Kolkata',
            'district' => 'Kolkata',
            'state_id' => 22,
            'pin' => '70010',
            'guardian_contact_number' => '9835700182',
            'whatsapp_number' => '9903652417',
            'email_id' => 'riya99@gmail.com',
            'qualification' => 'HS'

        ]);
        Student::create([
            'episode_id'=> 'a3',
            'student_name' => 'Suchismita Das',
            'father_name' => 'Sujan Das',
            'mother_name' => 'Kakali Das',
            'guardian_name' => 'piya Das',
            'relation_to_guardian' => 'mother',
            'dob' => '2000-08-09',
            'sex' => 'F',
            'address' => '39/b,G.T.Road',
            'city' => 'Kolkata',
            'district' => 'Howrah',
            'state_id' => 22,
            'pin' => '70010',
            'guardian_contact_number' => '9835700182',
            'whatsapp_number' => '9903652417',
            'email_id' => 'riya99@gmail.com',
            'qualification' => 'HS'

        ]);
        Student::create([
            'episode_id'=> 'a4',
            'student_name' => 'Raj Ghosh',
            'father_name' => 'Ratan Ghosh',
            'mother_name' => 'Mita Ghosh',
            'guardian_name' => 'Mita Ghosh',
            'relation_to_guardian' => 'mother',
            'dob' => '2001-11-21',
            'sex' => 'M',
            'address' => '10/b R.Sen Road',
            'city' => 'Siliguri',
            'district' => 'Siliguri',
            'state_id' => 22,
            'pin' => '734001',
            'guardian_contact_number' => '9835700182',
            'whatsapp_number' => '9903652417',
            'email_id' => 'rajghosh@gmail.com',
            'qualification' => 'HS'
        ]);
        Student::create([
            'episode_id'=> 'a5',
            'student_name' => 'Piyali Sen',
            'father_name' => 'Raju Sen',
            'mother_name' => 'Putul Sen',
            'guardian_name' => 'Putul Sen',
            'relation_to_guardian' => 'mother',
            'dob' => '2000-08-27',
            'sex' => 'o',
            'address' => '13/c,Rabindra Sarani',
            'city' => 'Kolkata',
            'district' => 'Kolkata',
            'state_id' => 22,
            'pin' => '700008',
            'guardian_contact_number' => '9805741496',
            'whatsapp_number' => '9732568412',
            'email_id' => 'piyali45@gmail.com',
            'qualification' => 'HS'
        ]);



    }
}

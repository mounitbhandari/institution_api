<?php

namespace Database\Seeders;




use App\Models\Ledger;
use App\Models\LedgerGroup;
use App\Models\TransactionType;
use App\Models\VoucherType;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserType;
use App\Models\State;
use App\Models\Course;







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


        $this->command->info('All States are added');
        //Transaction types
        TransactionType::create(['transaction_name'=>'Dr.','formal_name'=>'Debit','transaction_type_value'=>1]);
        TransactionType::create(['transaction_name'=>'Cr.','formal_name'=>'Credit','transaction_type_value'=>-1]);
        $this->command->info('Transaction Type Created');

        LedgerGroup::insert([
            ['group_name'=>'Current Assets'],           //1
            ['group_name'=>'Indirect Expenses'],        //2
            ['group_name'=>'Current Liabilities'],      //3
            ['group_name'=>'Fixed Assets'],             //4
            ['group_name'=>'Direct Incomes'],           //5
            ['group_name'=>'Indirect Incomes'],         //6
            ['group_name'=>'Bank Account'],             //7
            ['group_name'=>'Loans & Liabilities'],      //8
            ['group_name'=>'Bank OD'],                  //9
            ['group_name'=>'Branch & Division'],        //10
            ['group_name'=>'Capital Account'],          //11
            ['group_name'=>'Direct Expenses'],          //12
            ['group_name'=>'Cash in Hand'],             //13
            ['group_name'=>'Stock in Hand'],            //14
            ['group_name'=>'Sundry Creditors'],         //15
            ['group_name'=>'Sundry Debtors'],           //16
            ['group_name'=>'Suspense Account'],         //17
            ['group_name'=>'Indirect Income'],          //18
            ['group_name'=>'Sales Account'],            //19
            ['group_name'=>'Duties & Taxes'],           //20
            ['group_name'=>'Investment'],               //21
            ['group_name'=>'Purchase Account'],         //22
            ['group_name'=>'Investments']               //23
        ]);

        $this->command->info('Ledger groups are added');
        VoucherType::insert([
            ['voucher_type_name'=>'Sales Voucher'],              //1
            ['voucher_type_name'=>'Purchase Voucher'],           //2
            ['voucher_type_name'=>'Payment Voucher'],            //3
            ['voucher_type_name'=>'Receipt Voucher'],            //4
            ['voucher_type_name'=>'Contra Voucher'],             //5
            ['voucher_type_name'=>'Journal Voucher'],            //6
            ['voucher_type_name'=>'Credit Note Voucher'],        //7
            ['voucher_type_name'=>'Debit Note Voucher']          //8
        ]);
        $this->command->info('Voucher type created');

        Ledger::create([
            'episode_id' =>'a1',
            'ledger_name' => 'Bimal Paul',
            'billing_name' => 'Mr. Bimal Paul',
            'ledger_group_id' => 16,
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
        Ledger::create([
            'episode_id' =>'a2',
            'ledger_name' => 'Ramen Paul',
            'billing_name' => 'Mr. Ramen Paul',
            'ledger_group_id' => 16,
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

    //storing course
        Course::create([
           'course_code' => 'ab',
           'short_name' => 'Tally',
           'full_name' => 'Tally',
           'course_duration' => '1 year',
           'subject' => 'Tally'
        ]);

        Course::create([
            'course_code' => 'az',
            'short_name' => 'Ms word',
            'full_name' => 'Micro soft office word',
            'course_duration' => '4 week ',
            'subject' => 'Ms word'
         ]);

         Course::create([
            'course_code' => 'bc',
            'short_name' => 'Excel',
            'full_name' => 'Micro soft excel',
            'course_duration' => '1 year',
            'subject' => 'Ms excel'
         ]);

         Course::create([
            'course_code' => 'cd',
            'short_name' => 'Web Based Software Devolopment',
            'full_name' => 'Tally',
            'course_duration' => '2 year',
            'subject' => 'Software Devolopment'
         ]);

         Course::create([
            'course_code' => 'gh',
            'short_name' => 'Powerpoint',
            'full_name' => 'Powerpoint',
            'course_duration' => '1 week',
            'subject' => 'Powerpoint'
         ]);

    }
}

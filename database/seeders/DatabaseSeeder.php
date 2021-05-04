<?php

namespace Database\Seeders;




use App\Models\FeesModeType;
use App\Models\Ledger;
use App\Models\LedgerGroup;
use App\Models\Subject;
use App\Models\TransactionType;
use App\Models\VoucherType;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserType;
use App\Models\State;
use App\Models\Course;
use App\Models\DurationType;
use App\Models\StudentCourseRegistration;
use Illuminate\Support\Str;

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
            ['voucher_type_name'=>'Debit Note Voucher'],         //8
            ['voucher_type_name'=>'Fees Charged Journal Voucher'],//9

        ]);
        $this->command->info('Voucher type created');

        //Ledgers to be created other than Student
        Ledger::insert([
            /*1 Cash In Hand*/      ['episode_id' =>Str::random(20),'ledger_name'=>'Cash in Hand','billing_name'=>'Cash in Hand','ledger_group_id'=>13,'state_id'=>1,'transaction_type_id'=>1,'opening_balance'=>0,'is_student'=>0],
            /*2 Bank Account*/      ['episode_id' =>Str::random(20),'ledger_name'=>'Bank Account','billing_name'=>'Bank Account','ledger_group_id'=>7,'state_id'=>1,'transaction_type_id'=>1,'opening_balance'=>0,'is_student'=>0],
            /*3 Back Account 1*/    ['episode_id' =>Str::random(20),'ledger_name'=>'Bank Account 1','billing_name'=>'Bank Account 1','ledger_group_id'=>7,'state_id'=>1,'transaction_type_id'=>1,'opening_balance'=>0,'is_student'=>0],
            /*4 Bank Account 2*/    ['episode_id' =>Str::random(20),'ledger_name'=>'Bank Account 2','billing_name'=>'Bank Account 2','ledger_group_id'=>7,'state_id'=>1,'transaction_type_id'=>1,'opening_balance'=>0,'is_student'=>0],
            /*5 Purchase*/          ['episode_id' =>Str::random(20),'ledger_name'=>'Purchase','billing_name'=>'Purchase','ledger_group_id'=>22,'state_id'=>1,'transaction_type_id'=>1,'opening_balance'=>0,'is_student'=>0],
            /*6 Sale*/              ['episode_id' =>Str::random(20),'ledger_name'=>'Sale','billing_name'=>'Sale','ledger_group_id'=>19,'state_id'=>1,'transaction_type_id'=>2,'opening_balance'=>0,'is_student'=>0],
            /*7 Admission Fees*/    ['episode_id' =>Str::random(20),'ledger_name'=>'Admission Fees','billing_name'=>'Admission Fees','ledger_group_id'=>6,'state_id'=>1,'transaction_type_id'=>2,'opening_balance'=>0,'is_student'=>0],
            /*8 Admission Fees*/    ['episode_id' =>Str::random(20),'ledger_name'=>'Course Fees','billing_name'=>'Course Fees','ledger_group_id'=>6,'state_id'=>1,'transaction_type_id'=>2,'opening_balance'=>0,'is_student'=>0],
            /*9 Monthly Fees*/      ['episode_id' =>Str::random(20),'ledger_name'=>'Monthly Fees','billing_name'=>'Monthly Fees','ledger_group_id'=>6,'state_id'=>1,'transaction_type_id'=>2,'opening_balance'=>0,'is_student'=>0],
            /*9 Other Fees*/        ['episode_id' =>Str::random(20),'ledger_name'=>'Other Fees','billing_name'=>'Other Fees','ledger_group_id'=>6,'state_id'=>1,'transaction_type_id'=>2,'opening_balance'=>0,'is_student'=>0],
        ]);

        Ledger::create([
            'episode_id' =>'a1',
            'ledger_name' => 'Bimal Paul',
            'billing_name' => 'Mr. Bimal Paul',
            'ledger_group_id' => 16,
            'is_student' =>1,
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
            'is_student' =>1,
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
        Ledger::create([
            'episode_id' =>'a3',
            'is_student' =>1,
            'ledger_name' => 'XRamen Paul',
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

        Ledger::create([
            'episode_id' =>'a4',
            'is_student' =>1,
            'ledger_name' => 'Ramesh Chowdhury',
            'billing_name' => 'Mr. Ramesh Chowdhury',
            'ledger_group_id' => 16,
            'father_name' => 'Prakash Chowdhury',
            'mother_name' => 'Sumita Chowdhury',
            'guardian_name' => 'Prakash Chowdhury',
            'relation_to_guardian' => 'father',
            'dob' => '2000-05-15',
            'sex' => 'M',
            'address' => '13/c,R.N.Tagore Road',
            'city' => 'Kolkata',
            'district' => 'Kolkata',
            'state_id' => 22,
            'pin' => '70010',
            'guardian_contact_number' => '9835700182',
            'whatsapp_number' => '9903652417',
            'email_id' => 'rameshchowdhury@gmail.com',
            'qualification' => 'HS'

        ]);
        Ledger::create([
            'episode_id' =>'a5',
            'is_student' =>1,
            'ledger_name' => 'Smita Sen',
            'billing_name' => 'Miss. Smita Sen',
            'ledger_group_id' => 16,
            'father_name' => 'Rohit Sen',
            'mother_name' => 'Susmita Sen',
            'guardian_name' => 'Susmita Sen',
            'relation_to_guardian' => 'Mother',
            'dob' => '2000-05-15',
            'sex' => 'F',
            'address' => '13/c,R.N.Tagore Road',
            'city' => 'Kolkata',
            'district' => 'Kolkata',
            'state_id' => 22,
            'pin' => '70010',
            'guardian_contact_number' => '9835700182',
            'whatsapp_number' => '9903652417',
            'email_id' => 'sensusmita@gmail.com',
            'qualification' => 'Graduate'

        ]);
        Ledger::create([
            'episode_id' =>'a6',
            'is_student' =>1,
            'ledger_name' => 'Joy Paul',
            'billing_name' => 'Mr. Joy Paul',
            'ledger_group_id' => 16,
            'father_name' => 'Raja Paul',
            'mother_name' => 'Anita Paul',
            'guardian_name' => 'Raja Paul',
            'relation_to_guardian' => 'father',
            'dob' => '2000-05-15',
            'sex' => 'M',
            'address' => '13/c,R.N.Tagore Road',
            'city' => 'Kolkata',
            'district' => 'Kolkata',
            'state_id' => 22,
            'pin' => '70010',
            'guardian_contact_number' => '9835700182',
            'whatsapp_number' => '9903652417',
            'email_id' => 'pauljoy@gmail.com',
            'qualification' => 'HS'

        ]);
        Ledger::create([
            'episode_id' =>'a7',
            'is_student' =>1,
            'ledger_name' => 'Dinesh Agarwal',
            'billing_name' => 'Mr. Dinesh Agarwal',
            'ledger_group_id' => 16,
            'father_name' => 'Sitesh Agarwal',
            'mother_name' => 'Dipti Agarwal',
            'guardian_name' => 'Dipti Agarwal',
            'relation_to_guardian' => 'mother',
            'dob' => '2000-05-15',
            'sex' => 'M',
            'address' => '13/c,R.N.Tagore Road',
            'city' => 'Kolkata',
            'district' => 'Kolkata',
            'state_id' => 22,
            'pin' => '70010',
            'guardian_contact_number' => '9835700182',
            'whatsapp_number' => '9903652417',
            'email_id' => 'dinagarwal@gmail.com',
            'qualification' => '10th'

        ]);
        Ledger::create([
            'episode_id' =>'a8',
            'is_student' =>1,
            'ledger_name' => 'Prasen Chowdhury',
            'billing_name' => 'Mr. Prasen Chowdhury',
            'ledger_group_id' => 16,
            'father_name' => 'Susen Chowdhury',
            'mother_name' => 'Priya Chowdhury',
            'guardian_name' => 'priya Chowdhury',
            'relation_to_guardian' => 'mother',
            'dob' => '2000-05-15',
            'sex' => 'M',
            'address' => '13/c,R.N.Tagore Road',
            'city' => 'Kolkata',
            'district' => 'Kolkata',
            'state_id' => 22,
            'pin' => '70010',
            'guardian_contact_number' => '9835700182',
            'whatsapp_number' => '9903652417',
            'email_id' => 'prasenchowdhury@gmail.com',
            'qualification' => '12th'

        ]);
        Ledger::create([
            'episode_id' =>'a9',
            'is_student' =>1,
            'ledger_name' => 'Anandi Das',
            'billing_name' => 'Miss. Anandi Das',
            'ledger_group_id' => 16,
            'father_name' => 'Ananda Das',
            'mother_name' => 'Smrity Das',
            'guardian_name' => 'Ananda Das',
            'relation_to_guardian' => 'father',
            'dob' => '2000-05-15',
            'sex' => 'F',
            'address' => '13/c,R.N.Tagore Road',
            'city' => 'Kolkata',
            'district' => 'Kolkata',
            'state_id' => 22,
            'pin' => '70010',
            'guardian_contact_number' => '9835700182',
            'whatsapp_number' => '9903652417',
            'email_id' => 'dasanandi001@gmail.com',
            'qualification' => 'HS'

        ]);
        Ledger::create([
            'episode_id' =>'a10',
            'is_student' =>1,
            'ledger_name' => 'Priyobrata Chowdhury',
            'billing_name' => 'Mr. Priyobrata Chowdhury',
            'ledger_group_id' => 16,
            'father_name' => 'Surya Chowdhury',
            'mother_name' => 'Rini Chowdhury',
            'guardian_name' => 'Rini Chowdhury',
            'relation_to_guardian' => 'mother',
            'dob' => '2000-05-15',
            'sex' => 'M',
            'address' => '13/c,R.N.Tagore Road',
            'city' => 'Kolkata',
            'district' => 'Kolkata',
            'state_id' => 22,
            'pin' => '70010',
            'guardian_contact_number' => '9835700182',
            'whatsapp_number' => '9903652417',
            'email_id' => 'priyobratachowdhury@gmail.com',
            'qualification' => 'HS'

        ]);
    /*insert into durationType table*/
    DurationType::insert([
        /*1*/    ['duration_name' => 'Not Applicable'],
        /*2*/    ['duration_name' => 'Year'],
        /*3*/    ['duration_name' => 'Month'],
        /*4*/    ['duration_name' => 'Week'],
        /*5*/    ['duration_name' => 'Hours']
   ]);

    //Fees Modes
    FeesModeType::insert([
        ['fees_mode_type_name'=>'Monthly'],
        ['fees_mode_type_name'=>'Single']
    ]);
    //storing course
        Course::create([
           'fees_mode_type_id'=>1,
           'course_code' => 'ab',
           'short_name' => 'Tally',
           'full_name' => 'Tally',
           'course_duration' => 100,
           'duration_type_id' => '4'
        ]);

        Course::create([
            'fees_mode_type_id'=>2,
            'course_code' => 'az',
            'short_name' => 'Ms word',
            'full_name' => 'Micro soft office word',
            'course_duration' => 200,
            'duration_type_id' => '4'
         ]);

         Course::create([
            'fees_mode_type_id'=>2,
            'course_code' => 'bc',
            'short_name' => 'Excel',
            'full_name' => 'Micro soft excel',
            'course_duration' => 300,
            'duration_type_id' => '4'
         ]);

         Course::create([
            'fees_mode_type_id'=>1,
            'course_code' => 'cd',
            'short_name' => 'Web Based Software Devolopment',
            'full_name' => 'Tally',
            'course_duration' => 100,
            'duration_type_id' => '4'
         ]);

         Course::create([
            'fees_mode_type_id'=>1,
            'course_code' => 'gh',
            'short_name' => 'Powerpoint',
            'full_name' => 'Powerpoint',
            'course_duration' => 20,
            'duration_type_id' => '4'
         ]);
         Course::create([
            'fees_mode_type_id'=>1,
            'course_code' => 'ef',
            'short_name' => 'Office 10',
            'full_name' => 'Micosoft Office 10',
            'course_duration' => 20,
            'duration_type_id' => '4'
         ]);

         Course::create([
            'fees_mode_type_id'=>1,
            'course_code' => 'ij',
            'short_name' => 'C',
            'full_name' => 'Programming Language C',
            'course_duration' => 20,
            'duration_type_id' => '4'

         ]);

         Course::create([
            'fees_mode_type_id'=>1,
            'course_code' => 'kl',
            'short_name' => 'CP',
            'full_name' => 'Programming Language C+',
            'course_duration' => 20,
            'duration_type_id' => '4'
         ]);

         Course::create([
            'fees_mode_type_id'=>1,
            'course_code' => 'mn',
            'short_name' => 'CPP',
            'full_name' => 'Programming Language C++',
            'course_duration' => 20,
            'duration_type_id' => '4'
         ]);

         Course::create([
            'fees_mode_type_id'=>1,
            'course_code' => 'jv',
            'short_name' => 'JAVA',
            'full_name' => 'Programming Language JAVA',
            'course_duration' => 20,
            'duration_type_id' => '4'
         ]);

         Course::create([
            'fees_mode_type_id'=>1,
            'course_code' => 'ph',
            'short_name' => 'PYTHON',
            'full_name' => 'Programming Language PYTHON',
            'course_duration' => 20,
            'duration_type_id' => '4'
         ]);

         Course::create([
            'fees_mode_type_id'=>1,
            'course_code' => 'html',
            'short_name' => 'HTML',
            'full_name' => 'Hyper Text Markup Language',
            'course_duration' => 20,
            'duration_type_id' => '4'
         ]);

         Course::create([
            'fees_mode_type_id'=>1,
            'course_code' => 'js',
            'short_name' => 'JavaScript',
            'full_name' => 'Programming Language JavaScript',
            'course_duration' => 20,
             'duration_type_id' => '4'
         ]);

         Course::create([
            'fees_mode_type_id'=>1,
            'course_code' => 'sql',
            'short_name' => 'SQL',
            'full_name' => 'Structured Query Language',
            'course_duration' => 20,
             'duration_type_id' => '4'
         ]);






        Subject::insert([
            /*1*/    ['subject_code'=>'MSW','subject_short_name'=>'MS-Word','subject_full_name'=>'Microsoft Office','subject_duration'=>5,'duration_type_id' => '4','subject_description'=>'Microsoft office Word for beginners'],
            /*2*/    ['subject_code'=>'MSWA','subject_short_name'=>'MS-Word Advance','subject_full_name'=>'Advance Microsoft Office','subject_duration'=>10,'duration_type_id' => '4','subject_description'=>'Microsoft office word for advance user'],
            /*3*/    ['subject_code'=>'MSEX','subject_short_name'=>'MS-Excel','subject_full_name'=>'Microsoft Excel','subject_duration'=>10,'duration_type_id' => '4','subject_description'=>'Microsoft office excel for beginners'],
            /*4*/    ['subject_code'=>'MSEXA','subject_short_name'=>'MS-Excel Advance','subject_full_name'=>'Advance Microsoft Excel','subject_duration'=>20,'duration_type_id' => '4','subject_description'=>'Microsoft office excel for advance user'],
            /*4*/    ['subject_code'=>'MSPPT','subject_short_name'=>'MS-PowerPoint','subject_full_name'=>'Microsoft Power Point','subject_duration'=>20,'duration_type_id' => '4','subject_description'=>'Microsoft office Power Point'],

            /*5*/    ['subject_code'=>'EXCAXI-III','subject_short_name'=>'Computer Application','subject_full_name'=>'Computer Application for Class I to III','subject_duration'=>0,'duration_type_id' => '1','subject_description'=>'Computer Application for ClassI to III'],
            /*6*/    ['subject_code'=>'EXCAXIV-V','subject_short_name'=>'Computer Application','subject_full_name'=>'Computer Application for Class IV to V','subject_duration'=>0,'duration_type_id' => '1','subject_description'=>'Computer Application for Class IV to V'],


            /**/    ['subject_code'=>'C','subject_short_name'=>'C','subject_full_name'=>'Programming Language C','subject_duration'=>20,'duration_type_id' => '4','subject_description'=>'Programming Language For C'],
        ]);


        StudentCourseRegistration::create(['ledger_id'=>11,'course_id'=>1,'reference_number'=>1,'base_fee'=>3000,'discount_allowed'=>1200,'joining_date'=>'2019-01-08','effective_date'=>'2019-02-01','completion_date'=>'2019-11-05','is_completed'=>0]);
        StudentCourseRegistration::create(['ledger_id'=>11,'course_id'=>2,'reference_number'=>2,'base_fee'=>6900,'discount_allowed'=>3200,'joining_date'=>'2019-11-28','effective_date'=>'2019-12-01','completion_date'=>'2020-11-05','is_completed'=>0]);
        StudentCourseRegistration::create(['ledger_id'=>11,'course_id'=>3,'reference_number'=>3,'base_fee'=>6900,'discount_allowed'=>5200,'joining_date'=>'2020-12-28','effective_date'=>'2020-12-29','completion_date'=>'2021-04-05','is_completed'=>0]);
        StudentCourseRegistration::create(['ledger_id'=>11,'course_id'=>4,'reference_number'=>4,'base_fee'=>6900,'discount_allowed'=>5200,'joining_date'=>'2021-04-02','effective_date'=>'2021-04-05','is_started'=>0]);
        StudentCourseRegistration::create(['ledger_id'=>12,'course_id'=>4,'reference_number'=>5,'base_fee'=>6900,'discount_allowed'=>5200,'joining_date'=>'2020-02-28','effective_date'=>'2020-03-05','completion_date'=>'2020-11-05','is_completed'=>0]);
        StudentCourseRegistration::create(['ledger_id'=>13,'course_id'=>4,'reference_number'=>6,'base_fee'=>6900,'discount_allowed'=>5200,'joining_date'=>'2021-02-2','effective_date'=>'2021-03-01','is_started'=>0,'is_completed'=>1]);

        StudentCourseRegistration::create(['ledger_id'=>13,'course_id'=>4,'reference_number'=>7,'base_fee'=>6900,'discount_allowed'=>5200,'joining_date'=>'2021-02-2','effective_date'=>'2021-03-01','is_started'=>0,'is_completed'=>0]);
        StudentCourseRegistration::create(['ledger_id'=>13,'course_id'=>4,'reference_number'=>8,'base_fee'=>6900,'discount_allowed'=>5200,'joining_date'=>'2021-02-2','is_completed'=>0]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\BloodType;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\TheParents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('the_parents')->delete();

        $nationalities = Nationality::all();
        $bloodTypes = BloodType::all();
        $religions = Religion::all();
        $fakerEn = \Faker\Factory::create();
        $fakerAr = \Faker\Factory::create('ar_SA');
        $password = Hash::make('parent123');

        // Common bilingual jobs array
        $bilingualJobs = [
            ['en' => 'Engineer', 'ar' => 'مهندس'],
            ['en' => 'Teacher', 'ar' => 'معلم'],
            ['en' => 'Doctor', 'ar' => 'طبيب'],
            ['en' => 'Accountant', 'ar' => 'محاسب'],
            ['en' => 'Manager', 'ar' => 'مدير'],
        ];

        for ($i = 0; $i < 500; $i++) {
            TheParents::create([
                'email' => $fakerEn->unique()->safeEmail,
                'password' =>$password,

                // Father Information
                'father_name' => [
                    'en' => $fakerEn->name('male'),
                    'ar' => $fakerAr->name('male')
                ],
                'father_national_id' => $fakerEn->unique()->numerify('##############'),
                'father_passport_id' => $fakerEn->unique()->bothify('??######'),
                'father_phone_number' => $fakerEn->phoneNumber,
                'father_job' => $bilingualJobs[array_rand($bilingualJobs)],
                'father_address' => $fakerEn->address,
                'nationality_father_id' => $nationalities->random()->id,
                'blood_type_father_id' => $bloodTypes->random()->id,
                'religion_father_id' => $religions->random()->id,

                // Mother Information
                'mother_name' => [
                    'en' => $fakerEn->name('female'),
                    'ar' => $fakerAr->name('female')
                ],
                'mother_national_id' => $fakerEn->unique()->numerify('##############'),
                'mother_passport_id' => $fakerEn->unique()->bothify('??######'),
                'mother_phone_number' => $fakerEn->phoneNumber,
                'mother_job' => $bilingualJobs[array_rand($bilingualJobs)],
                'mother_address' => $fakerEn->address,
                'nationality_mother_id' => $nationalities->random()->id,
                'blood_type_mother_id' => $bloodTypes->random()->id,
                'religion_mother_id' => $religions->random()->id,
            ]);
        }
    }
}
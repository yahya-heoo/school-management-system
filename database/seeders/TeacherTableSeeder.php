<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Models\Section;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class TeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('teachers')->delete();
        DB::table('section_teacher')->delete();


        $sections = Section::all();
        $specializations = Specialization::all();
        $genders = Gender::all();
        $fakerEn = Faker::create();
        $fakerAr = Faker::create('ar_SA');


        $genderId = rand(1, 2);
        $genderLabel = ($genderId === 1) ? 'male' : 'female';

        $nameEn = $fakerEn->name($genderLabel);
        $nameAr = $fakerAr->name($genderLabel);

        for ($i = 0; $i < 50; $i++) {
            $teacher = Teacher::create([
                'email' => $fakerEn->unique()->safeEmail,
                'name' => [
                    'en' => $nameEn,
                    'ar' => $nameAr
                ],
                'password' => Hash::make('password'),
                'specialization_id' => $specializations->random()->id,
                'gender_id' => $genders->random()->id,
                'joining_date' => $fakerEn->dateTimeBetween('-5 years')->format('Y-m-d'),
                'address' => $fakerEn->address,
            ]);
            $randomSectionIds = $sections->random(rand(1, 3))->pluck('id')->toArray();


            $teacher->sections()->attach($randomSectionIds);
        }
    }
}

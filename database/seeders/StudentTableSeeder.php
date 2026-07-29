<?php

namespace Database\Seeders;

use App\Models\BloodType;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use App\Models\TheParents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class StudentTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('students')->delete();

        $sections = Section::with(['classes'])->get();
        $parents = TheParents::all();
        $nationalities = Nationality::all();
        $bloodTypes = BloodType::all();

        $fakerEn = Faker::create();
        $fakerAr = Faker::create('ar_SA');
        $password =  Hash::make('12345678');

        for ($i = 0; $i < 2500; $i++) {

            $genderId = rand(1, 2);
            $genderLabel = ($genderId === 1) ? 'male' : 'female';

            $nameEn = $fakerEn->name($genderLabel);
            $nameAr = $fakerAr->name($genderLabel);

            $section = $sections->random();
            $classroom = $section->classes;
            $parent = $parents->random();
            $bloodType = $bloodTypes->random();
            $nationality = $nationalities->random();

            Student::create([
                'name' => [
                    'en' => $nameEn,
                    'ar' => $nameAr
                ],
                'email' => $i . $fakerEn->unique()->safeEmail,
                'password' => $password,
                'gender_id' => $genderId,
                'nationality_id' => $nationality->id,
                'blood_type_id' => $bloodType->id,
                'birth_date' => $fakerEn->date('Y-m-d', '2018-01-01'),
                'grade_id' => $classroom->grade_id,
                'class_id' => $section->class_id,
                'section_id' => $section->id,
                'parent_id' => $parent->id,
                'academic_year' => '2026',
            ]);
        }
    }
}

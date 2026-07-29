<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classrooms')->delete();
        $primary = Grade::where('name->en', 'Primary Stage')->first();
        $secondary = Grade::where('name->en','Secondary Stage')->first();
        $highSchool = Grade::where('name->en', 'High School')->first();

        $classes = [
            [
                'name' => ['en' => '1st Class', 'ar' => 'الصف الأول'],
                'grade_id' => $primary->id
            ],
            [
                'name' => ['en' => '2nd Class', 'ar' => 'الصف الثاني'],
                'grade_id' => $primary->id
            ],
            [
                'name' => ['en' => '3rd Class', 'ar' => 'الصف الثالث'],
                'grade_id' => $primary->id
            ],
            [
                'name' => ['en' => '4th Class', 'ar' => 'الصف الرابع'],
                'grade_id' => $primary->id
            ],

            // Secondary Stage Classes (5th-9th)
            [
                'name' => ['en' => '5th Class', 'ar' => 'الصف الخامس'],
                'grade_id' => $secondary->id
            ],
            [
                'name' => ['en' => '6th Class', 'ar' => 'الصف السادس'],
                'grade_id' => $secondary->id
            ],
            [
                'name' => ['en' => '7th Class', 'ar' => 'الصف السابع'],
                'grade_id' => $secondary->id
            ],
            [
                'name' => ['en' => '8th Class', 'ar' => 'الصف الثامن'],
                'grade_id' => $secondary->id
            ],
            [
                'name' => ['en' => '9th Class', 'ar' => 'الصف التاسع'],
                'grade_id' => $secondary->id
            ],

            // High School Classes (10th-12th)
            [
                'name' => ['en' => '10th Class', 'ar' => 'الصف العاشر'],
                'grade_id' => $highSchool->id
            ],
            [
                'name' => ['en' => '11th Class', 'ar' => 'الصف الحادي عشر'],
                'grade_id' => $highSchool->id
            ],
            [
                'name' => ['en' => '12th Class', 'ar' => 'الصف الثاني عشر'],
                'grade_id' => $highSchool->id
            ]
        ];

        foreach($classes as $classroom){
            Classroom::create($classroom);
        }

    }
}

<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Specialization;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectTableSeeder extends Seeder
{
    
    public function run()
{
    DB::table('subjects')->delete();

    // Get all 5 specializations (Art, Maths, Arabic, English, Biology)
    $specializations = Specialization::all();
    
    // Get 5 unique random teachers (one per subject)
    $teachers = Teacher::inRandomOrder()->take(5)->get();

    foreach ($specializations as $index => $specialization) {
        // Assign a unique teacher to this specialization
        $teacher = $teachers[$index];

        // Loop through all grades
        $grades = Grade::all();
        foreach ($grades as $grade) {
            // Get all classes belonging to this grade
            $classes = Classroom::where('grade_id', $grade->id)->get();
            
            // Create a subject for each class in the grade
            foreach ($classes as $class) {
                Subject::create([
                    'name' => $specialization->name,
                    'grade_id' => $grade->id,
                    'class_id' => $class->id,
                    'teacher_id' => $teacher->id,
                ]);
            }
        }
    }
}
}
<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionTableSeeder extends Seeder
{
    function run()
    {
        DB::table('sections')->delete();
        $classrooms = Classroom::all();
        $sectionLetters = ['A', 'B', 'C'];

        foreach ($classrooms as $classroom) {
            for ($i = 0; $i < count($sectionLetters); $i++) {
                Section::create([
                    'name' => [
                        'en' => 'Section ' . $sectionLetters[$i],
                        'ar' => $sectionLetters[$i] . ' القسم',
                    ],
                    'class_id' => $classroom->id,
                    'status' => 1,
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SpecializationTableSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('specializations')->delete();
        $specializations = [
            ['en' => 'Art', 'ar' => 'تربية فنية'],
            ['en' => 'Maths', 'ar' => 'رياضيات'],
            ['en' => 'Arabic', 'ar' => 'لغة عربية'],
            ['en' => 'English', 'ar' => 'لغة إنكليزية '],
            ['en' => 'Biology', 'ar' => 'علم أحياء']
        ];
        
        foreach ($specializations as $specialization) {
            Specialization::create([
                'name' => $specialization
            ]);
        }
    }
}

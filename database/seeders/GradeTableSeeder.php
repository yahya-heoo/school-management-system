<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeTableSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('grades')->delete();
        $grades=[
            [
                'en'=>'Primary Stage',
                'ar'=>'المرحلة الابتدائية'
            ],
            [
                'en'=>'Secondary Stage',
                'ar'=>'المرحلة الإعدادية'
            ],
            [
                'en'=>'High School',
                'ar'=>'المرحلة الثانوية'
            ],
        ];

        foreach($grades as $grade){
            Grade::create([
                'name'=>$grade
            ]);
        }
    }
}

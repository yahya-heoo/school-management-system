<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('settings')->delete();

        $data =[
            ['key' => 'current_session', 'value' =>'2025-2026' ],
            ['key' => 'school_title', 'value' =>'YA' ],
            ['key' => 'school_name' , 'value' =>'Yahya is the BEST' ],
            ['key' => 'school_email', 'value' =>'ya@gmail.com' ],
            ['key' => 'end_first_term', 'value' =>'01-12-2025' ],
            ['key' => 'end_second_term', 'value' =>'01-06-2026' ],
            ['key' => 'address', 'value' => 'Syria'],
            ['key' => 'phone', 'value' => '00000000' ],
        ];

        DB::table('settings')->insert($data);
        
    }
}
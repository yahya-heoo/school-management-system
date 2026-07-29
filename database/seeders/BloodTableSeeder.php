<?php

namespace Database\Seeders;

use App\Models\BloodType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blood_types')->delete();
        $bgs=['A+','A-','B+','B-','AB+','AB-','O+','O-'];
        foreach($bgs as $bg){
            BloodType::create([
                'name'=>$bg
            ]);
        }

    }
}

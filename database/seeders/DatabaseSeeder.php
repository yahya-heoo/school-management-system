<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GradeTableSeeder::class);
        $this->call(ClassTableSeeder::class);
        $this->call(SectionTableSeeder::class);
        $this->call(BloodTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(ReligionTableSeeder::class);
        $this->call(NationalityTableSeeder::class);
        $this->call(SpecializationTableSeeder::class);
        $this->call(TeacherTableSeeder::class);
        $this->call(ParentTableSeeder::class);
        $this->call(StudentTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        // $this->call(SubjectTableSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
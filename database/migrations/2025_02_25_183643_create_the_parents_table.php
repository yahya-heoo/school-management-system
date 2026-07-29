<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('the_parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
        
            // Father information
            $table->string('father_name');
            $table->string('father_national_id');
            $table->string('father_passport_id');
            $table->string('father_phone_number');
            $table->string('father_job');
            $table->string('father_address');
        
            $table->foreignId('nationality_father_id')
                ->unsigned()
                ->references('id')
                ->on('nationalities')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('blood_type_father_id')
                ->unsigned()
                ->references('id')
                ->on('blood_types')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('religion_father_id')
                ->unsigned()
                ->references('id')
                ->on('religions')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        
            // Mother information
            $table->string('mother_name');
            $table->string('mother_national_id');
            $table->string('mother_passport_id');
            $table->string('mother_phone_number');
            $table->string('mother_job');
            $table->string('mother_address');
        
            $table->foreignId('nationality_mother_id')
                ->unsigned()
                ->references('id')
                ->on('nationalities')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('blood_type_mother_id')
                ->unsigned()
                ->references('id')
                ->on('blood_types')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('religion_mother_id')
                ->unsigned()
                ->references('id')
                ->on('religions')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        
            $table->timestamps();
        });
        
 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('the_parents');
    }
};

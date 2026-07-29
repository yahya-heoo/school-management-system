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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('password');

            $table->foreignId('specialization_id')
            ->references('id')
            ->on('specializations')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('gender_id')
            ->references('id')
            ->on('genders')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->date('joining_date');
            $table->text('address');
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
        Schema::dropIfExists('teachers');
    }
};

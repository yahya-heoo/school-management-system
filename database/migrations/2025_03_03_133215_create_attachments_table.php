<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('storage_path');
            $table->integer('attachmentable_id');
            $table->string('attachmentable_type');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
};
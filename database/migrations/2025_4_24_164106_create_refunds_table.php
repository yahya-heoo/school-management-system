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
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->references('id')->on('students')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('invoice_id')->references('id')->on('invoices')->cascadeOnDelete()->cascadeOnUpdate()->nullable();
            $table->foreignId('receipt_id')->references('id')->on('receipts')->cascadeOnDelete()->cascadeOnUpdate()->nullable();
            $table->decimal('refund_amount', 10, 2);
            $table->text('reason')->nullable();
            $table->date('refund_date');
            
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
        Schema::dropIfExists('refunds');
    }
};
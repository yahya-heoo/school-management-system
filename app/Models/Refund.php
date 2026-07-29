<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function students(){
        return $this->belongsTo(Student::class,'student_id');
    }
    public function invoices(){
        return $this->belongsTo(Invoice::class,'invocie_id');
    }
    public function receipts(){
        return $this->belongsTo(Receipt::class,'receipt_id');
    }

    
}
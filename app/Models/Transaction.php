<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded=[];
    
       public function students(){
        return $this->belongsTo(Student::class,'student_id');
       }
       public function invoices(){
        return $this->belongsTo(Invoice::class,'invoice_id');
       }
}
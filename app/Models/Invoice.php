<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded=[];
    public function grades(){
        return $this->belongsTo(Grade::class,'grade_id');
       }
       public function classes(){
        return $this->belongsTo(Classroom::class,'class_id');
       }
       public function students(){
        return $this->belongsTo(Student::class,'student_id');
       }
       public function fees(){
        return $this->belongsTo(Fee::class,'fee_id');
       }
}

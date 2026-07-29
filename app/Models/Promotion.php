<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function from_sections(){
        return $this->belongsTo(Section::class,'from_section_id');
       }
       public function from_grades(){
        return $this->belongsTo(Grade::class,'from_grade_id');
       }
       public function from_classes(){
        return $this->belongsTo(Classroom::class,'from_class_id');
       }
    public function to_sections(){
        return $this->belongsTo(Section::class,'to_section_id');
       }
       public function to_grades(){
        return $this->belongsTo(Grade::class,'to_grade_id');
       }
       public function to_classes(){
        return $this->belongsTo(Classroom::class,'to_class_id');
       }
       public function students(){
        return $this->belongsTo(Student::class,'student_id')->withTrashed();
       }


}

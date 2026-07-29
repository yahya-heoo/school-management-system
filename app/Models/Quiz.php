<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quiz extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded=[];
    public $translatable = ['title'];

    
    public function sections(){
        return $this->belongsTo(Classroom::class,'section_id');
       }
    public function teachers(){
        return $this->belongsTo(Teacher::class,'grade_id');
       }
    public function subjects(){
        return $this->belongsTo(Subject::class,'class_id');
       }
}
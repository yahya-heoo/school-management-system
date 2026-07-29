<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable=['name', 'grade_id', 'class_id', 'teacher_id'];
    public $translatable = ['name'];


    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public function classes()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class,'subject_teacher');
    }
    public function specializations(){
        return $this->belongsTo(Specialization::class,'specialization_id');
       }
}

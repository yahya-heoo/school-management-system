<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded=[];
    protected $guard = 'teacher';
   

   public function genders(){
    return $this->belongsTo(Gender::class,'gender_id');
   }
   public function sections(){
    return $this->belongsToMany(Section::class,'section_teacher');
   }
   public function subjects(){
    return $this->belongsToMany(Subject::class,'subject_teacher');
   }
   public function specializations(){
    return $this->belongsTo(Specialization::class,'specialization_id');
   }
    
}
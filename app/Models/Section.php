<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];
    protected $fillable=[
        'name',
        'status',
        'class_id',
    ];
    
    public function classes(){
        return $this->belongsTo(Classroom::class,'class_id');
    }
    public function teachers(){
        return $this->belongsToMany(Teacher::class,'section_teacher');
       }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];
    protected $fillable=[
        'name',
        'notes',
    ];
    public function subjects(){
        return $this->hasMany(Subject::class);
    }
    public function classes(){
        return $this->hasMany(Classroom::class);
    }
    public function sections() {
    return $this->hasManyThrough(Section::class, Classroom::class, 'grade_id', 'class_id');
}
    
}

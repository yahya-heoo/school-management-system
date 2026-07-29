<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded=[];
    public $translatable = ['fee_type'];

    public function grades(){
        return $this->belongsTo(Grade::class,'grade_id');
       }
       public function classes(){
        return $this->belongsTo(Classroom::class,'class_id');
       }


}

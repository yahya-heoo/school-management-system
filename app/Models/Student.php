<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Student extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;


    public $translatable = ['name'];
    protected $guarded = [];
    protected $guard = 'student';

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public function class()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }
    public function parent()
    {
        return $this->belongsTo(TheParents::class, 'parent_id');
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }
    public function blood_type()
    {
        return $this->belongsTo(BloodType::class, 'blood_type_id');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}

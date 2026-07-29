<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'teacher_id',
        'grade_id',
        'class_id',
        'section_id',
        'attendance_status',
        'attendance_date'
    ];

    public function students()
    {
        return $this->belongsTo(Student::class);
    }
}
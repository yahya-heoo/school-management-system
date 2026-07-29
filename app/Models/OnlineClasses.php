<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineClasses extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'integration',
        'grade_id',
        'class_id',
        'section_id',
        'user_id',
        'meeting_id',
        'topic',
        'duration',
        'password',
        'start_time',
        'start_url',
        'join_url'
    ];

    protected $casts = [
        'start_time' => 'datetime',
    ];


    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function classes()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function sections()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
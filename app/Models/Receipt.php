<?php

namespace App\Models;

use App\Http\Controllers\Students\StudentController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function students() {
        return $this->belongsTo(Student::class,'student_id')->withTrashed();
    }

    public function invoices() {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
    
}
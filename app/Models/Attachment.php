<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=['file_name', 'storage_path', 'attachmentable_id','attachmentable_type'];

    

    public function attachmentable()
    {
        return $this->morphTo();
    }

}
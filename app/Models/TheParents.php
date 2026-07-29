<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TheParents extends Authenticatable

{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['father_name', 'mother_name', 'father_job', 'mother_job'];
    protected $guarded=[];
    protected $guard = 'parent';

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }
}
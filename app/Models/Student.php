<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UniversityClass;

class Student extends Model
{
    use SoftDeletes;
    public function universityClass()
    {
        return $this->belongsTo(UniversityClass::class);
    }
}

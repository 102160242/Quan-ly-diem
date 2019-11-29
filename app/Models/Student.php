<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    public function universityClass()
    {
        return $this->belongsTo(UniversityClass::class)/*->withDefault(function () {
            return collect(new UniversityClass);
        })*/;
    }
}

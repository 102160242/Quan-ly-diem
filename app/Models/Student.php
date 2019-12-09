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
    /**
     * Summary of meta
     */
    public static function meta()
    {
        $data = [];
        $data['from'] = UniversityClass::min('academic_year');
        $data['to'] = UniversityClass::max('academic_year');
        return $data;
    }
}

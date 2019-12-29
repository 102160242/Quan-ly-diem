<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name'];
    /**
     * Summary of courseClasses
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseClasses()
    {
        return $this->hasMany(CourseClass::class);
    }

    public static function meta(){
        $data = [];
        $universityclass = UniversityClass::select('id', 'name')->get()->toArray();
        $data['university_class'] = $universityclass;
        return $data;
    }
}

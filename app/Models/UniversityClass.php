<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityClass extends Model
{
    //protected $table = 'classes';

    protected $fillable = [
        'name', 'faculty_id', 'academic_year'
    ];

    public $timestamps = false;
    public function students()
    {
        return $this->hasMany(Student::class)/*->withDefault(function () {
            return Student::collection();
        });*/;
    }
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
    public function headUsers()
    {
        return $this->belongsToMany(User::class/*, 'class_user', 'class_id', 'user_id'*/);
    }
    public function totalStudents()
    {
        return $this->hasMany(Student::class)->count();
    }
    public static function meta()
    {
        $data = [];
        $faculties = Faculty::all();
        $data['meta'] = $faculties;
        return $data;
    }
}

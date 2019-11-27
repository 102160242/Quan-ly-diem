<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\User;

class UniversityClass extends Model
{
    //protected $table = 'classes';
    public $timestamps = false;
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function headUsers()
    {
        return $this->belongsToMany(User::class/*, 'class_user', 'class_id', 'user_id'*/);
    }
}

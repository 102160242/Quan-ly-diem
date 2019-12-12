<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    public function universityClasses()
    {
        return $this->hasMany(UniversityClass::class);
    }
}

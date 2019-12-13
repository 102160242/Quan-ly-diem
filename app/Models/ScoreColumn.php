<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScoreColumn extends Model
{
    public $timestamps = false;
    protected $fillable = ['course_class_id', 'name', 'ratio'];

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
    public function courseClass()
    {
        return $this->belongsTo(CourseClass::class);
    }
}

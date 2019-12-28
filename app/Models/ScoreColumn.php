<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class ScoreColumn extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $softCascade = ['scores'];

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

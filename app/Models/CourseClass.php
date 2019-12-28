<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class CourseClass extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;

    protected $softCascade = ['scoreColumns'];
    protected $fillable = [
        'course_id', 'name', 'credits', 'year', 'teacher_id', 'semester'
    ];

    public function getAllStudentsScores() // Lấy bảng điểm cả lớp
    {
        $data = [];
        foreach($this->students as $student)
        {
            $data[] = array("id" => $student->id, "name" => $student->name, "scores" => $student->getCourseClassScores($this->id));
        }
        return $data;
    }
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function scoreColumns()
    {
        return $this->hasMany(ScoreColumn::class);
    }
    public static function meta()
    {
        $data = [];
        //$data['teachers'] = DB::table('course_class_user')->pluck('user_id');
        $teachers = self::groupBy('teacher_id')->with('teacher')->get();
        foreach($teachers as $t)
        {
            $data['teachers'][] = array($t->teacher_id, $t->teacher->user->name);
        }
        $data['from'] = self::min('year');
        $data['to'] = self::max('year');
        return $data;
    }
}

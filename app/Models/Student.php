<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    public function getAllCourseClassesScores() // Lấy toàn bộ điểm của các khoá học của sv
    {
        $data = [];
        foreach($this->courseClasses as $courseClass)
        {
            $data[] = array("id" => $courseClass->id, "name" => $courseClass->name, "scores" => $this->getCourseClassScores($courseClass->id));
        }
        return $data;
    }
    public function courseClasses()
    {
        return $this->belongsToMany(CourseClass::class);
    }
    public function getCourseClassScores($course_class_id)
    {
        $course_class = CourseClass::find($course_class_id);
        $scoreColumns = $course_class->scoreColumns;
        $scores = $this->scores()->get();
        $data = [];
        foreach($scoreColumns as $scoreColumn)
        {
            $data["columns"][] = array("id" => $scoreColumn->id, "name" => $scoreColumn->name, "ratio" => $scoreColumn->ratio);
            $score = $scores->where('score_column_id', $scoreColumn->id)->first();
            //$score = $scores->where(['score_column_id' => $scoreColumn->id])->first()->score;
            if($score != null)
            {
                $data["data"][] = $score->score;
            }
            else $data["data"][] = null;
        }
        return $data;
    }
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
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

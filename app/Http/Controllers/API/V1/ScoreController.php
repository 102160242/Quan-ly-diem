<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->has('view') || ($request->get('view') != "student" && $request->get('view') != "course_class"))
        {
            return response()->error("Thiếu thông tin!");
        }
        else
        {
            if(!$request->has('id'))
            {
                return response()->error("Thiếu ID!");
            }
            if($request->get('view') == "student")
            {
                $student = \App\Models\Student::find($request->get('id'));
                return response()->success($student->getAllCourseClassesScores());
            }
            else
            {
                $courseClass = \App\Models\CourseClass::find($request->get('id'));
                return response()->success($courseClass->getAllStudentsScores());
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //if($request->validator->fails())
        //{
        //    return response()->error($request->validator->errors()->all(), 422);
        //}
        if(!is_null($score = Score::where(['score_column_id' => $request->get('score_column_id'), 'student_id' => $request->get('student_id')])->first()))
        {
            $score->score = $request->get('score');
            $score->save();
            return response()->success([], ["Cập nhật điểm thành công."], 201);
        }
        else
        {
            $score = Score::create($request->all());
            if($score != null)
                return response()->success([], ["Cập nhật điểm thành công."], 201);
        }
        return response()->error("Không thể cập nhật điểm.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Score  $scores
     * @return \Illuminate\Http\Response
     */
    public function show(Score $scores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Score  $scores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Score $scores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Score  $scores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $scores)
    {
        //
    }

    public function meta()
    {
        
    }
}

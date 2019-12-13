<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\CourseClass;
use App\Models\ScoreColumn;
use Illuminate\Http\Request;
use App\Http\Resources\CourseClass as CourseClassResource;
use Gate;
use Illuminate\Support\Facades\Auth;

class CourseClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Gate::denies('course_classes.viewAny')) return $this->notAuthorized();
        $params = $request->only(['year', 'semester']);

        // Loc theo quyen
        if(Auth::user()->roles->isAdmin()) $courseClass = CourseClass::with('course');
        else $courseClass = Auth::user()->teacherProfile->courseClasses()->with('course');

        return response()->success(
            CourseClassResource::collection($courseClass->where($params)->get())
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('course_classes.create')) return $this->notAuthorized();
        /*if($request->validator->fails())
        if($request->validator->fails())
        {
            return response()->error($request->validator->errors()->all(), 422);
        }*/
        $courseClass = CourseClass::create($request->except(['score_columns']));
        if($courseClass != null)
        {
            $columns = $request->get('score_columns');
            foreach($columns as $column){
                $courseClass->scoreColumns()->create($column);
            }
            return response()->success(new CourseClassResource($courseClass), ["Tạo Lớp học phần mới thành công."], 201);
        }
        else
            return response()->error("Không thể tạo Lớp học phần mới.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseClass  $courseClass
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $courseClass = CourseClass::find($id);
        if(Gate::denies('course_classes.view', $courseClass)) return $this->notAuthorized();

        //$courseClass->getAllStudentsScores();
        return response()->success(new CourseClassResource($courseClass->load('course'), $courseClass->load('scoreColumns')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseClass  $courseClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Gate::denies('course_classes.update', $courseClass)) return $this->notAuthorized();

        $courseClass = CourseClass::find($id);
        $courseClass->update($request->except('score_columns') );
        $columns = $request->get('score_columns');
        foreach($columns as $column){
            if(!isset($column['id']))
                $courseClass->scoreColumns()->create($column);
            else
            {
                ScoreColumn::findOrFail($column['id'])->update($column);
            }
        }
        return response()->success(new CourseClassResource($courseClass));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseClass  $courseClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseClass $courseClass)
    {
        if(Gate::denies('course_classes.delete', $courseClass)) return $this->notAuthorized();
        $courseClass->delete();
        return response()->success("", "Đã xoá thành công.");
    }
    /**
     * Summary of meta
     */
    public function meta()
    {
        $data = CourseClass::meta();
        return response()->success($data);
    }
}

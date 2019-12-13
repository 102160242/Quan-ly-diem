<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Resources\Teacher as TeacherResource;
use Gate;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('teachers.viewAny')) return $this->notAuthorized();
        return response()->success(
            TeacherResource::collection(Teacher::with('user')->get())
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
        if(Gate::denies('teachers.create')) return $this->notAuthorized();
        if($request->validator->fails())
        {
            return response()->error($request->validator->errors()->all(), 422);
        }
        $class = Teacher::create($request->all());
        if($class != null)
            return response()->success(new Teacher($class), ["Tạo Giảng viên mới thành công."], 201);
        else
            return response()->error("Không thể tạo Giảng viên mới.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        if(Gate::denies('teachers.view', $teacher)) return $this->notAuthorized();
        return response()->success(new TeacherResource($teacher->load('courseClasses', 'user')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        if(Gate::denies('teachers.update', $teacher)) return $this->notAuthorized();
        $teacher->update($request->all());
        return response()->success(new TeacherResource($teacher));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        if(Gate::denies('teachers.delete', $teacher)) return $this->notAuthorized();
        $teacher->delete();
        return response()->success("", "Đã xoá thành công.");
    }
}

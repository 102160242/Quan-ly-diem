<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\CourseClass;
use Illuminate\Http\Request;
use App\Http\Resources\CourseClass as CourseClassResource;

class CourseClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->only(['year', 'semester']);
        return response()->success(
            CourseClassResource::collection(CourseClass::where($params)->with('course')->get())
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
        if($request->validator->fails())
        {
            return response()->error($request->validator->errors()->all(), 422);
        }
        $courseClass = CourseClass::create($request->all());
        if($courseClass != null)
            return response()->success(new CourseClassResource($courseClass), ["Tạo Lớp học phần mới thành công."], 201);
        else
            return response()->error("Không thể tạo Lớp học phần mới.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseClass  $courseClass
     * @return \Illuminate\Http\Response
     */
    public function show(CourseClass $courseClass)
    {
        return response()->success(new CourseClassResource($courseClass));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseClass  $courseClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseClass $courseClass)
    {
        $courseClass->update($request->all());
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
        $courseClass->delete();
        return response()->success("", "Đã xoá thành công.");
    }
    /**
     * Summary of meta
     */
    public function meta()
    {
        $data = array();
        $data = CourseClass::meta();
        return response()->success($data);
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\Course as CourseResource;
use Illuminate\Support\Facades\Auth;
use Gate;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('courses.viewAny')) return $this->notAuthorized();
        return response()->success(
            CourseResource::collection(Course::get())
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
        if(Gate::denies('courses.create')) return $this->notAuthorized();
        //if($request->validator->fails())
        //{
        //    return response()->error($request->validator->errors()->all(), 422);
        //}
        $course = Course::create($request->all());
        if($course != null)
            return response()->success(new CourseResource($course), ["Tạo Học phần mới thành công."], 201);
        else
            return response()->error("Không thể tạo học phần mới.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        if(Gate::denies('courses.view', $course)) return $this->notAuthorized();
        return response()->success(new CourseResource($course->load('courseClasses')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        if(Gate::denies('courses.update', $course)) return $this->notAuthorized();
        $course->update($request->all());
        return response()->success(new CourseResource($course));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        if(Gate::denies('courses.delete', $course)) return $this->notAuthorized();
        $course->delete();
        return response()->success("", "Đã xoá thành công.");
    }

   public function meta()
   {
       $data = Course::meta();
       return response()->success($data);
   }
}

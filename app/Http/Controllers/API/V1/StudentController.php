<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\Student as StudentResource;
use App\Http\Requests\Students\Create as CreateStudentRequest;
use Gate;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Gate::denies('students.viewAny')) return $this->notAuthorized();
        return response()->success(
            StudentResource::collection(Student::where($request->only(['university_class_id']))->whereHas('universityClass', function ($query) use($request){
                $query->where($request->only(['academic_year']));
            })->with('universityClass')->get())
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStudentRequest $request)
    {
        if(Gate::denies('students.create')) return $this->notAuthorized();
        if($request->validator->fails())
        {
            return response()->error($request->validator->errors()->all(), 422);
        }
        $student = Student::create($request->all());
        if($student != null)
            return response()->success(new StudentResource($student), ["Tạo Sinh viên mới thành công."], 201);
        else
            return response()->error("Không thể tạo Sinh viên mới.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        if(Gate::denies('students.view', $student)) return $this->notAuthorized();
        return response()->success(new StudentResource($student->load('universityClass')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        if(Gate::denies('students.update', $student)) return $this->notAuthorized();
        $student->update($request->all());
        return response()->success(new StudentResource($student));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        if(Gate::denies('students.delete', $student)) return $this->notAuthorized();
        $student->delete();
        return response()->success("", "Đã xoá thành công.");
    }
    /**
     * Summary of meta
     */
    public function meta()
    {
        $data = Student::meta();
        return response()->success($data);
    }
}

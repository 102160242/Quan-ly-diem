<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\UniversityClass;
use Illuminate\Http\Request;
use App\Http\Resources\UniversityClass as UniversityClassResource;
use Gate;
use Illuminate\Support\Facades\Auth;
class UniversityClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('university_classes.viewAny')) return $this->notAuthorized();

        if(Auth::user()->roles->isAdmin()) $universityClass = UniversityClass::with('headUsers');
        else $universityClass = Auth::user()->universityClasses()->with('headUsers');

        return response()->success(
            UniversityClassResource::collection($universityClass->get())
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
        if(Gate::denies('university_classes.create')) return $this->notAuthorized();
        //if($request->validator->fails())
        //{
        //    return response()->error($request->validator->errors()->all(), 422);
        //}
        $class = UniversityClass::create($request->all());
        if($class != null)
            return response()->success(new UniversityClassResource($class), ["Tạo Lớp mới thành công."], 201);
        else
            return response()->error("Không thể tạo Lớp mới.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UniversityClass  $class_
     * @return \Illuminate\Http\Response
     */
    public function show(UniversityClass $class)
    {
        if(Gate::denies('university_classes.view', $class)) return $this->notAuthorized();
        return response()->success(new UniversityClassResource($class->load('headUsers', 'students')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UniversityClass  $class_
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UniversityClass $class)
    {
        if(Gate::denies('university_classes.update', $class)) return $this->notAuthorized();
        $class->update($request->all());
        return response()->success(new UniversityClassResource($class));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UniversityClass  $class_
     * @return \Illuminate\Http\Response
     */
    public function destroy(UniversityClass $class)
    {
        if(Gate::denies('university_classes.delete', $class)) return $this->notAuthorized();
        $class->delete();
        return response()->success("", "Đã xoá thành công.");
    }

    public function meta()
    {
        $data = UniversityClass::meta();
        return response()->success($data);
    }
}

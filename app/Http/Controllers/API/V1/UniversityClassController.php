<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\UniversityClass;
use Illuminate\Http\Request;
use App\Http\Resources\UniversityClass as UniversityClassResource;

class UniversityClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->success(
            UniversityClassResource::collection(UniversityClass::with('headUsers')->paginate())
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
        $class = UniversityClass::create($request->all());
        if($class != null)
            return response()->success(new UniversityClassResource($class), ["Created new Class successfully."], 201);
        else
            return response()->error("Can't create new Class.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UniversityClass  $class_
     * @return \Illuminate\Http\Response
     */
    public function show(UniversityClass $class)
    {
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
        $class->delete();
        return response()->success("", "Deleted successfully.");
    }
}

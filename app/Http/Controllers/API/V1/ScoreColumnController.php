<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\ScoreColumn;
use Illuminate\Http\Request;

class ScoreColumnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ScoreColumn  $scoreColumn
     * @return \Illuminate\Http\Response
     */
    public function show(ScoreColumn $scoreColumn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScoreColumn  $scoreColumn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScoreColumn $scoreColumn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScoreColumn  $scoreColumn
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScoreColumn $scoreColumn)
    {
        $scoreColumn->delete();
        return response()->success("", "Đã xoá thành công.");
    }
}

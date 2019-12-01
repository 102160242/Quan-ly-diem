<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use App\Http\Requests\Auth\RegisterRequest;
use  App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->success(
            UserResource::collection(User::with('universityClasses')->paginate())
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        if($request->validator->fails())
        {
            return response()->error($request->validator->errors()->all(), 422);
        }
        $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => bcrypt($request->password),
        ]);
        if($user != null)
            return response()->success(new UserResource($user), ["Tạo Người dùng mới thành công."], 201);
        else
            return response()->error("Không thể tạo Người dùng mới.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->success(new UserResource($user->load('universityClasses')));
    }
    public function me()
    {
        return response()->success(new UserResource(Auth::user()->load('universityClasses')));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->success(new UserResource($user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->success("", "Đã xoá thành công.");
    }
}

<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use App\Http\Requests\Auth\RegisterRequest;
use  App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('users.viewAny')) return $this->notAuthorized();
        return response()->success(
            UserResource::collection(User::with('universityClasses')->get())
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

        if(Gate::denies('users.create')) return $this->notAuthorized();
        
        if($request->validator->fails())
        {
            return response()->error($request->validator->errors()->all(), 422);
        }
        $params = $request->only(['name','gender','birthday','phone_number','email','password','avatar']);
        $file = $request->file('avatar');
        $path = $file->storeAs('public/avatars', md5($request->get('email')).".".$file->getClientOriginalExtension());
        $params['avatar'] = $path;
        $params['password'] = bcrypt($params['password']);
        $params['birthday'] = Carbon::parse($params['birthday']);
        $user = User::create($params);
        if($user != null)
        {
            //if(true)
            //{
            if($request->get('is_teacher'))
                $user->roles->setTeacher(1);
            if($request->get('is_admin'))
                $user->roles->setAdmin(1);

            //}
            return response()->success(new UserResource($user), ["Tạo Người dùng mới thành công."], 201);
        }
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
        if(Gate::denies('users.view', $user)) return $this->notAuthorized();
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
        if(Gate::denies('users.update', $user)) return $this->notAuthorized();
        
        $user->update($request->except(['is_teacher', 'is_admin', '_method']));
        if($request->get('is_teacher'))
            $user->roles->setTeacher();
        else
            $user->roles->unsetTeacher();
        if($request->get('is_admin'))
            $user->roles->setAdmin();
        else
            $user->roles->unsetAdmin();
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
        if(Gate::denies('users.delete', $user)) return $this->notAuthorized();
        $user->delete();
        return response()->success("", "Đã xoá thành công.");
    }
}

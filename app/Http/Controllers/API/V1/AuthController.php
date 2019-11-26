<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        if ($request->validator->fails()) {
            return response()->error($request->validator->errors()->all(), 422);
        }
        else
        {
            $user = User::create([
              'name' => $request->name,
              'email' => $request->email,
              'password' => bcrypt($request->password),
            ]);

            $token = auth()->login($user);

            return response()->success(["token" => $token], ["Registered new account successfully."], 201);
        }
    }

    public function login(LoginRequest $request)
    {
        if ($request->validator->fails()) {
            return response()->error($request->validator->errors()->all());
        }
        else
        {
            $credentials = $request->only(['email', 'password']);

            if (!$token = auth()->attempt($credentials)) {
                return response()->error(["The email or password you have entered is wrong."]);
            }

            return response()->success(["token" => $token], ["Logged in successfully."]);
        }
    }
}

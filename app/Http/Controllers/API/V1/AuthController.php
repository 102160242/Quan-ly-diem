<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $messages = [
            //'required' => 'The :attribute field is required.',
            //'unique' => 'The :attribute has been taken.',
            //'min' => 'The :attribute must has a length at least :min',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ], $messages);

        if ($validator->fails()) {
            return $this->respondJson(false, $validator->errors()->all(), []);
        }
        else
        {
            $user = User::create([
              'name' => $request->name,
              'email' => $request->email,
              'password' => bcrypt($request->password),
            ]);

            $token = auth()->login($user);

            return $this->respondJson(true, ["Registered new account successfully."], ["token" => $token]);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => '', 'success' => false, 'messages' => $validator->errors()->all()]);
        }
        else
        {
            $credentials = $request->only(['email', 'password']);

            if (!$token = auth()->attempt($credentials)) {
                return $this->respondJson(false, ["The email or password you have entered is wrong."], []);
            }

            return $this->respondJson(true, ["Logged in successfully."], ["token" => $token]);
        }
    }

    protected function respondJson($success, $messages = [], $data = [], $header_code = 200)
    {
        return response()->json([
            'data' => $data,
            'success' => $success,
            'messages' => $messages
        ], $header_code);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('username', $request->username)->first();
        if ($user && $user->email) {
            return response([
                'msg' => 'enter email',
            ], 422);
        }
        if (! $user) {
            $user = User::where('email', $request->username)->first();
        }
        if (! $user || md5($request->password) != $user->password) {
            return response([
                'msg' => 'Invalid username or password',
            ], 401);
        }
        $token = $user->createToken('apiToken')->plainTextToken;
        $res = [
            'user' => ['id' => $user->id,
                'username' => $user->userName,
                'email' => isset($user->email) ? $user->email : null,
                'uuid' => $user->uuid,
                'is_admin' => $user->is_admin == 1 ? true : false,
            ],
            'token' => $token,
        ];

        return response($res, 201);

    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}

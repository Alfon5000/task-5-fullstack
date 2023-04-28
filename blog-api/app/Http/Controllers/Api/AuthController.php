<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:4',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $validator->errors()
                ]
            );
        }

        $validated = $validator->validated();
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'User has been registered.'
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ]);
        }

        $validated = $validator->validated();

        if (Auth::attempt($validated)) {
            $token = $request->user()->createToken('token')->accessToken;

            return response()->json([
                'status' => 'success',
                'message' => 'User has been logged in.',
                'access_token' => $token
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'status' => 'success',
            'message' => 'User has been logged out.'
        ]);
    }
}

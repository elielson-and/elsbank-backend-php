<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($data))
        {
            $user = Auth::user();
            $token = $user->createToken('JWT')->plainTextToken;

            return response()->json([
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'auth_token' => $token
            ],200);

        }
        return response()->json(['message' => 'Invalid credentials or this user does not exists'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}

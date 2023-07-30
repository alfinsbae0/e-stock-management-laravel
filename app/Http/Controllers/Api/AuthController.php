<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function register(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);

            $token = $user->createToken('token')->plainTextToken;

            return response()->json([
                'message' => 'berhasil daftar',
                'data' => $user,
                'token' => $token
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Kesalahan AuthController.register'
            ]);
        }
    }

    function login(Request $request)
    {
        try {
            $user = User::where('email', '=', $request->input('email'))->firstOrFail();
            if (Hash::check($request->input('password'), $user->password)) {
                $token = $user->createToken('token')->plainTextToken;

                return response()->json([
                    'message' => 'berhasil login',
                    'data' => $user,
                    'token' => $token
                ]);
            }

            return response()->json([
                'message' => 'Kesalahan Login',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Kesalahan AuthController.login'
            ]);
        }
    }

    function logout(Request $request)
    {
        try {
            $user = User::findOrFail($request->input('user_id'));

            $user->tokens()->delete();

            return response()->json(
                'berhasil Logout',
                200
            );
            return response()->json([
                'message' => 'Kesalahan Logout',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Kesalahan AuthController.logout'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $input = $request->only('email', 'password');
            $validator = Validator::make($input, [
                'email' => 'required|email',
                'password' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->getMessageBag(),
                ], 400);
            }
            if (!Auth::attempt($input)) {
                return response()->json(['message' => 'Invalid credentials' , 'data' => 'SKIP_REDIRECTION', 'success' => false], 401);
            }
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => 'Login successfully',
                'data' => [
                    'user' => [
                        'id' => isset($user->id) ? $user->id : null,
                        'email' => isset($user->email) ? $user->email : null,
                        'name' => isset($user->name) ? $user->name : null,
                        'role_id' => isset($user->role_id) ? $user->role_id : null,
                    ],
                    'token' => $token
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}

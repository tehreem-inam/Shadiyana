<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where(
            'phone_number',
            $request->validated('phone_number')
        )->first();

        if (
            !$user ||
            !$user->password ||
            !Hash::check(
                $request->validated('password'),
                $user->password
            )
        ) {
            return response()->json([
                'message' => 'Invalid phone number or password.',
            ], 401);
        }

        if (!$user->is_verified) {
            return response()->json([
                'message' => 'Please verify your phone number first.',
            ], 403);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful.',
            'user' => $user,
            'roles' => $user->getRoleNames(),
            'token' => $token,
        ]);
    }
}
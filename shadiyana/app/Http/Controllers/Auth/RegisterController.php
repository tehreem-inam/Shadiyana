<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'full_name' => $request->validated('full_name'),
            'phone_number' => $request->validated('phone_number'),
            'country_code' => $request->validated('country_code'),
            'email' => $request->validated('email'),
            'password' => $request->validated('password'),
            'profile_image' => $request->validated('profile_image'),
            'is_verified' => false,
        ]);

        $user->assignRole('customer');

        return response()->json([
            'message' => 'Customer registered successfully.',
            'user' => $user,
        ], 201);
    }
}
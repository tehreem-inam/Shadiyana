<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
// use Illuminate\Validation\ValidationException;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;

use App\Http\Resources\Auth\UserResource;



class AuthController extends Controller
{
    /**
     * Register a new customer.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'phone_number' => ['required', 'string', 'max:30', 'unique:users,phone_number'],
            'country_code' => ['required', 'string', 'max:10'],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone_number' => $validated['phone_number'],
            'country_code' => $validated['country_code'],
            'email' => $validated['email'] ?? null,
            'password' => $validated['password'],
            'role' => 'customer',
            'is_verified' => false,
            'status' => 'active',
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

       return response()->json([
    'message' => 'Customer registered successfully.',
    'user' => new UserResource($user),
    'token' => $token,
], 201);
    }

    /**
     * Login user.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $validated = $request->validate([
            'phone_number' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('phone_number', $validated['phone_number'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'phone_number' => ['The provided credentials are incorrect.'],
            ]);
        }

        if ($user->status !== 'active') {
            return response()->json([
                'message' => 'Your account is not active.',
            ], 403);
        }

        $user->update([
            'last_login_at' => now(),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

       return response()->json([
    'message' => 'Login successful.',
    'user' => new UserResource($user),
    'token' => $token,
]);
    }

    /**
     * Logout authenticated user.
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful.',
        ]);
    }

    /**
     * Get authenticated user's profile.
     */
public function profile(Request $request): JsonResponse
{
    $user = $request->user();

    // Token missing, invalid, expired, or user cannot be authenticated
    if (!$user) {
        return response()->json([
            'message' => 'Unauthorized. Please provide a valid authentication token.',
        ], 401);
    }

    // Load vendor profile only for vendor users
    if ($user->role === 'vendor') {
        $user->load('vendor');
    }

    return response()->json([
        'message' => 'Profile retrieved successfully.',
        'user' => new UserResource($user),
    ]);
}
    /**
     * Change authenticated user's password.
     */

  public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized. Please provide a valid authentication token.',
            ], 401);
        }

        $validated = $request->validated();

        if (!Hash::check($validated['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The current password is incorrect.'],
            ]);
        }

        if (Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['The new password must be different from your current password.'],
            ]);
        }

        $user->update([
            'password' => $validated['password'],
        ]);

        $user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Password changed successfully.',
            'token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }
}
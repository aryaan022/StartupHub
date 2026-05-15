<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController
{
    /**
     * Register a new user
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'id' => Str::uuid(),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role' => $request->role ?? 'job_seeker',
            'is_active' => true,
        ]);

        // Create role-specific profile
        $this->createUserProfile($user);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'user' => $user->only('id', 'email', 'first_name', 'last_name', 'role'),
            'token' => $token,
        ], 201);
    }

    /**
     * Login user
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        if (!$user->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Account is inactive',
            ], 403);
        }

        $user->update(['last_login_at' => now()]);
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'user' => $user->only('id', 'email', 'first_name', 'last_name', 'role'),
            'token' => $token,
        ]);
    }

    /**
     * Logout user
     */
    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully',
        ]);
    }

    /**
     * Get current user
     */
    public function getCurrentUser(): JsonResponse
    {
        $user = auth()->user();

        return response()->json([
            'success' => true,
            'user' => $user->load('investorProfile', 'jobSeekerProfile'),
        ]);
    }

    /**
     * Create role-specific profile
     */
    private function createUserProfile(User $user): void
    {
        if ($user->role === 'investor') {
            $user->investorProfile()->create([
                'id' => Str::uuid(),
            ]);
        } elseif ($user->role === 'job_seeker') {
            $user->jobSeekerProfile()->create([
                'id' => Str::uuid(),
            ]);
        }
    }
}

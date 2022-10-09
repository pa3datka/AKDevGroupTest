<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public function register(RegisterRequest $request, UserRepository $userRepository): JsonResponse
    {
        $fields = $request->all();
        $fields['password'] = Hash::make($fields['password']);

        try {
            $user = $userRepository->createUser($fields);
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status' => true,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);

        } catch (\Exception $e) {
            return response()->json(['status' => false], 500);
        }
    }

    public function login(LoginRequest $request, UserRepository $userRepository): JsonResponse
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = $userRepository->getUserByEmail($request->email);
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

        return response()->json(['message' => 'Login information is invalid.'], 401);
    }

    public function me(): JsonResponse
    {
        return response()->json(['user' => Auth::user()]);
    }

    public function logout(): void
    {
        Auth::user()->currentAccessToken()->delete();
    }
}

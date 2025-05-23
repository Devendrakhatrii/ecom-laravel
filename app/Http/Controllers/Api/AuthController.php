<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginUserRequest;
use App\Models\Cart;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{



    public function login(LoginUserRequest $request): JsonResponse
    {
        try {
            $loginData = $request->validated();
            $user = User::where(
                'email',
                $loginData['email']
            )->first();

            if (!$user || !Hash::check($loginData['password'], $user->password)) {
                return response()->json($data = [
                    'message' => 'invalid credential'
                ], status: 401);
            }

            $token = $user->createToken('api_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'access_token' => $token,
                'message' => 'logged in succesfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'not able to create user',
                'error' => $e->getMessage()
            ],  400);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        try {

            $request->user()->tokens()->delete();
            return response()->json([
                'message' => 'logged out succesfully',

            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}

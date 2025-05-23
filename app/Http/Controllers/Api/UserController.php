<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Cart;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponse;

    public function store(StoreUserRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            $cart = Cart::create(['user_id' => $user->user_id]);
            DB::commit();
            return $this->success(
                $user,
                'user created succesfully',
                200
            );
        } catch (Exception $e) {
            DB::rollBack();
            return $this->fails(
                'user not created',
                400,
                $e->getMessage()
            );
        }
    }

    public function index()
    {
        try {

            $user = Auth::user();
            if (!$user) {
                return $this->fails('unable to get user');
            }
            return $this->success($user, 'user fetched succesfully');
        } catch (Exception $e) {
            return $this->fails('unable to create user', $e->getMessage());
        }
    }
}

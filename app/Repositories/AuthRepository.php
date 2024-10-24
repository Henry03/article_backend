<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function     login($request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Email or password is incorrect.'
            ], 401);
        }

        $user = User::where('email', $credentials['email'])->first();
        $token = $user->createToken('authToken')->plainTextToken;
        return [
            'message' => 'Login Success',
            'status' => true,
            'user' => $user,
            'token' => $token
        ];
    }
}

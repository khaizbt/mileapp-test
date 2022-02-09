<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        // return $request;
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        // return $user;
        $token = $user->createToken('auth_token')->plainTextToken;
        // return $token;
        return response()
            ->json(['message' => 'Login Success','access_token' => $token, 'token_type' => 'Bearer', ]);
    }
}

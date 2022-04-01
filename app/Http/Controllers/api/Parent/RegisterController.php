<?php

namespace App\Http\Controllers\api\Parent;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParentRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(ParentRequest $request)
    {
        $this->setTokenName();

        $credentials = $request->validated();

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ]);

        Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ]);


        $token = $user->createToken($this->tokenName)->plainTextToken;

        $responseBody = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json([
            'status' => 200,
            'message' => 'User Create Successfully',
            'body' => $responseBody
        ]);
    }
}

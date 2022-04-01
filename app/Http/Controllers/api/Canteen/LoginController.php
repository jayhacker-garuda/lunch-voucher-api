<?php

namespace App\Http\Controllers\api\Canteen;

use App\Http\Controllers\Controller;
use App\Http\Requests\CanteenRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $tokenName;

    protected function setTokenName()
    {
        return $this->tokenName = config('app.name') . '-Canteen';
    }

    public function login(CanteenRequest $request)
    {
        $this->setTokenName();

        $credentials = $request->validated();

        (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']]))
            ? $token = auth()->user()->createToken($this->tokenName)->plainTextToken
            : $errors = trans('auth.failed');

            if(Auth::check()){

                // dd("can-update");
                $newUser = User::where(['email' => $credentials['email']])->update(['active' => 'active']);
                // dd($newUser);
        }
        if(!Auth::check()){

            $newUser = User::where(['email' => $credentials['email']])->update(['active' => 'not-active']);
        }


        $responseBody = [
            'user' => auth()->user(),
            'token' => ($token) ?? $this->tokenName
        ];

        return response()->json([
            'status' => 200,
            'message' => ($errors) ?? 'Canteen Login',
            'body' => $responseBody
        ]);
    }

    public function logout(Request $request)
    {
        $newUser = User::where(['email' => $request->email])->update(['active' => 'not-active']);
        auth()->user()->tokens()->delete();

        // Auth::logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logged Out'
        ]);
    }
}

<?php

namespace App\Http\Controllers\api\Admin\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCanteenStaffRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function create(CreateCanteenStaffRequest $request)
    {
        $credentials = $request->validated();

        $staffCreated = User::create([
            'name' => $credentials->name,
            'email' => $credentials->email,
            'user_type' => $credentials->user_type,
            'password' => $credentials->password,
        ]);

        ($staffCreated)
        ? $responseBody = ['name' => $staffCreated->name]
        : $errors = trans('auth.failed');


        return response()->json([
            'message' =>($errors) ?? 'Admin Create Canteen-Staff',
            'body' => $responseBody
        ],200);
    }
}

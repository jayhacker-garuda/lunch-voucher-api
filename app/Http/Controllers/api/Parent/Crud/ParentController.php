<?php

namespace App\Http\Controllers\api\Parent\Crud;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function active(Request $request){

        $user = User::where('email', $request->email)->first();

        if($user->active === 'active')
        {
            return response()->json([
                'body' => $user,
                'message' => 'active'
            ],200);
        }

        return response()->json(['message' => 'not-active'],403);
    }
}

<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class LoginController extends ApiController
{
    public function login(Request $request){

        $creds = $request->only(['email', 'password']);

        // $token = auth()->attempt($creds);

        if(!$token = auth()->attempt($creds)) {
            return response()->json(['error' => 'Incorrect email/password'], 401);
        }

        return response()->json(['token' => $token]);
    }
}

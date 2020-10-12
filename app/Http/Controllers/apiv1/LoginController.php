<?php

namespace App\Http\Controllers\apiv1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $login = $request->validate([
            // 'email' => 'required|string',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        if(!Auth::attempt($login))
        {
            return response(['message'=> 'Invalid Login Credentials.']);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return response(['user' => Auth::user(), 'access_token' => $accessToken]);
    }
}

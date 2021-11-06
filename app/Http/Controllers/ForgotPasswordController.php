<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Password;
use App\User;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    //
    public function forgot(Request $request)
    {
        // print_r($request->email);exit; 
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            $credentials = request()->validate(['email' => 'required|email']);
            Password::sendResetLink($credentials);
            return response()->json(["msg" => 'Reset password link sent on your email id.']);
        } else {
            return response()->json(["msg" => 'no']);
        }


        
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Password;

use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    //
    public function forgot() {
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return response()->json(["msg" => 'Reset password link sent on your email id.']);
    }
}

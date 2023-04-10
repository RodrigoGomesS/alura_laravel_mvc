<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials) == false) {
            return response()->json('Não autorizado', 401);
        }


        $user = Auth::user();
        $token = $request->user()->createToken('token');

        return ['token' => $token->plainTextToken];
    }
}

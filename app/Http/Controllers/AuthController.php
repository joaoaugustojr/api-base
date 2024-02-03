<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\HttpResponses;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return $this->error('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        $user = $request->user();
        $user->tokens()->delete();

        return $this->response('Authorized', Response::HTTP_OK, [
            'token' => $user->createToken('auth')->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->response('Logout successfully', Response::HTTP_OK);
    }
}

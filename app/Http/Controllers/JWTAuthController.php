<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JWTAuthController extends Controller
{
    public function __invoke(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $issuedAt = time();

            $payload = [
                'iss' => 'https://api.mintdev.me',
                'aud' => 'https://api.mintdev.me',
                'iat' => $issuedAt,
                'bf' => $issuedAt,
                'data' => [
                    'email' => $user->email,
                    'name' => $user->name,
                ]
            ];

            $jwt = JWT::encode($payload, config('jwt.JWT_SECRET'), 'HS256');

            return json_encode([
                'status' => 'success',
                'token' => $jwt,
            ]);

        } else {
            return response(json_encode([
                'status' => 'failure',
                'message' => 'wrong credentials',
            ]),
                status: 401);
        }
    }
}

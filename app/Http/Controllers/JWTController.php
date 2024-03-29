<?php

namespace App\Http\Controllers;


use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class JWTController extends Controller
{
    public function __invoke(Request $request)
    {
        $token = preg_replace('/^Bearer\s*/', '', $request->header('Authorization'));

        try {
            $decoded = JWT::decode($token, new Key(config('jwt.JWT_SECRET'), 'HS256'));
            return response()->json([
                'status' => 'success',
                'decoded_payload' => $decoded,
            ]);
        }
        catch (Exception $e){
            return response(json_encode([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]),status: 401);
        }

    }
}

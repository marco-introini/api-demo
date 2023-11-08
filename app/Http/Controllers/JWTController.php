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
        $token = str($request->header('Authorization'))
            ->replace('Bearer','',)
            ->remove(" ");

        try {
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            return response()->json($decoded);
        }
        catch (Exception $e){
            return response(json_encode(['Error' => $e->getMessage()]),status: 401);
        }

    }
}
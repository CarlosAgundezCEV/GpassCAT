<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use \Firebase\JWT\JWT;
use Validator;
use Response;
use JWTAuth;
use Illuminate\Support\Facades\Auth;

class APILoginController extends Controller
{

	const KEY = "key";

        public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        $credentials = $request->only('email', 'password');
        $jwt = JWT::encode($credentials,self::KEY);
        try {
            if (! $credentials) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json([
        	'token' => $jwt
        ]);
    }
}

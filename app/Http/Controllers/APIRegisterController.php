<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use App\User;
use Validator;
use Response;

class APIRegisterController extends Controller
{

	const KEY = "key";

        public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|string',
            'password'=> 'required|min:8|string'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);
        $user = User::first();
        $credentials = $request->only('email', 'password');
        $jwt = JWT::encode($credentials,self::KEY);

        return response()->json([
        	'token' => $jwt]
        );
    }



}

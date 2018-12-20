<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\Http\Controllers\APILoginController;
use \Firebase\JWT\JWT;
use Validator;
use Response;


class CategoryController extends Controller
{
    
	const KEY = "key";

    public function store(Request $request)
    {
    	$headers = getallheaders();
    	$tokenHeader = $headers['Authorization'];
    	$userDecoded = JWT::decode($tokenHeader,self::KEY, array('HS256'));

    	$validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        Category::create([
            'name' => $request->get('name'),
            'id' => $request->get('id'),
        ]);
        $category = Category::first();
    	}
    }

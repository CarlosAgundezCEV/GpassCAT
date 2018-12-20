<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \Firebase\JWT\JWT;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const KEY = "key";

    protected function checkLogin($email, $password)
    {
    	$userSaved = User::where('email', $email)->first();
    	$emailSaved = $userSaved->email;
    	$passwordSaved = $userSaved->password;

    	if ($emailSaved == $email && $passwordSaved == $password) {
    		return true;    	
    	    	}
    	return false;
    }
}

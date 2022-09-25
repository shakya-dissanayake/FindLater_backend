<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(){
        return 'Hello Login!';
    }

    public function register(){
        return response()->json('Hello Register!');
    }

    public function logout(){
        return response()->json('Hello Logout!');
    }
}

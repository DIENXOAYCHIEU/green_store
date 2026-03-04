<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController{

    public function login(){
        return view('user.login.index');
    }

    public function handleLogin(Request $request){
        $credentials = $request->only('key', 'password');
        dd(['key'=>$credentials['key'],'pw'=>$credentials['password']]);
    }

}

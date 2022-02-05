<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }
    
    public function getLogin(){
        return view('auth.login');
    }

    public function postLogin(Request $request){
        if(Auth::attempt([
            'email' =>$request->inputEmailUser,
            'password' => $request->password
        ])){
            return redirect('/home');
        }
        else{
            return back()->withErrors([
                'message' => 'The email Username or password is incorrect, or maybe your Account have not approve'
            ]);
        }
    }
}

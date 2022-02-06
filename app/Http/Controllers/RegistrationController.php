<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function create()
    {
        return view('auth.register');
    }

    public function registrationPost(Request $request)
    {
        $this->validate(request(), [
            'username' => 'unique:users',
            'password' => 'confirmed'
        ]);
        
        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->status = 'active';
        $user->role_id = $request->role;
        $user->save();
        
        return redirect()->to('/signin')->with('status', 'Akun Berhasil Di buat!');
    }
}

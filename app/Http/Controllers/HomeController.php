<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        if (auth()->check() ){
            return Redirect::route('dasboard');
        }else{
            return view ('auth.login');
        }
    }
}

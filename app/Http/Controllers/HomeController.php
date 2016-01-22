<?php

namespace Troovami\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Troovami\Http\Requests;
use Troovami\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
    	return view('home');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        Auth::logout();

        //return route('register');
        //return "Hola";
        return redirect(route('register'));
    }
}

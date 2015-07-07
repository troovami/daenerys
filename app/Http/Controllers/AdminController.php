<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class AdminController extends Controller
{
    public function index(){
    	$users = User::All();
        return view('admin.admin',compact('users'))->with('page_title', 'Principal');
    	
    }

    public function profile(){    	
        return view('admin.profile')->with('page_title', 'Perfil');    	      	
    }
    /*
    public function profile($id){
    	$user = User::find($id);
        return view('admin.profile',['user'=>$user])->with('page_title', 'Perfil');    	      	
    }
    */
}

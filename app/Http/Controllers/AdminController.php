<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Session;
use Redirect;
use DB;

class AdminController extends Controller
{
	
	public function index(){
    	$roles = DB::table('cat_roles')->orderBy('str_rol')->lists('str_rol','id');                       
        return view('admin.create',compact('roles'))->with('page_title', 'Agregar');
    	
    }

    public function all(){
    	$users = User::All();
        return view('admin.admin',compact('users'))->with('page_title', 'Principal');
    	
    }

    public function profile(){    	
        return view('admin.profile')->with('page_title', 'Perfil');    	      	
    }    

    public function create(Request $request)
    {
        $this->validate($request, [
	        'name'         => 'required|max:255|unique:tbl_admins',
            'str_cedula'   => 'required|max:255|unique:tbl_admins',   
            'str_nombre'   => 'required|max:255',
            'str_apellido' => 'required|max:255',
            'password'     => 'required|confirmed|min:6',
            'email'        => 'required|email|max:255|unique:tbl_admins',
            'str_telefono' => 'required|max:255',
            'lng_idrol'    => 'required|max:255',
    	]);
        
     	User::create([
            'name'         => $request['name'],
            'str_cedula'   => $request['str_cedula'],
            'str_nombre'   => $request['str_nombre'],
            'str_apellido' => $request['str_apellido'],
            'password'     => bcrypt($request['password']),
            'email'        => $request['email'],
            'str_telefono' => $request['str_telefono'],
            'lng_idrol'    => $request['lng_idrol'],
        ]);
        //return Redirect::to('/');'message','Usuario Registrado Exitosamente'        
        /*
        $data = array(
    		'page_title'  => 'Agregar',
    		'message'   => 'Usuario Registrado Exitosamente'    		
		);
		*/
		Session::flash('message', 'Usuario Registrado Exitosamente');        
        return Redirect::route('admin.create');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
    	$roles = DB::table('cat_roles')->orderBy('str_rol')->lists('str_rol','id');
        $user = User::find($id);
        //return view('admin.edit',['user'=>$user]);
        //return view('admin.create',compact('roles'))->with('page_title', 'Agregar');
        return view('admin.edit',['user'=>$user],compact('roles'))->with('page_title', 'Editar');
        //return "Usuario a Editar" . $id;
    }  

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
    	$this->validate($request, [
	        'name'         => 'required|max:255|unique:tbl_admins',
            'str_cedula'   => 'required|max:255|unique:tbl_admins',   
            'str_nombre'   => 'required|max:255',
            'str_apellido' => 'required|max:255',            
            'email'        => 'required|email|max:255|unique:tbl_admins',
            'str_telefono' => 'required|max:255',
            'lng_idrol'    => 'required|max:255',
    	]);    	

        $user = User::find($id);
        $user->fill($request->all());
        $user->save();
        Session::flash('message', 'Usuario Creado Exitosamente');
        return Redirect::route('admin.edit',$id);
        
    }


}

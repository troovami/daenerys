<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'getLogout']);
        
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'         => 'required|max:255|unique:tbl_admins',
            'str_cedula'   => 'required|max:255|unique:tbl_admins',   
            'str_nombre'   => 'required|max:255',
            'str_apellido' => 'required|max:255',
            'password'     => 'required|confirmed|min:6',
            'email'        => 'required|email|max:255|unique:tbl_admins',
            'str_telefono' => 'required|max:255',
            'lng_idrol'    => 'required|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'         => $data['name'],
            'str_cedula'   => $data['str_cedula'],
            'str_nombre'   => $data['str_nombre'],
            'str_apellido' => $data['str_apellido'],
            'password'     => bcrypt($data['password']),
            'email'        => $data['email'],
            'str_telefono' => $data['str_telefono'],
            'lng_idrol'    => $data['lng_idrol'],
        ]);
    }

    public function loginPath()
    {
        return route('login');
    }

    /**
    * Get the post regiter / login redirect path
    *
    * @return string
    */
    public function redirectPath()
    {
        return route('home');
    }
}

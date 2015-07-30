<?php

namespace Troovami\Http\Controllers;

use Illuminate\Http\Request;

use Troovami\Http\Requests;
use Troovami\Http\Controllers\Controller;
use Troovami\Persona;
use Session;
use Redirect;
use DB;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $personas = Persona::All();
        //return $personas;
        return view('persona.persona',compact('personas'))->with('page_title', 'Principal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $dias = array();
        for ($i = 1; $i <= 31; $i++){ $dias[$i] = $i; }
        $meses = array();
        for ($j = 1; $j <= 12; $j++){ $meses[$j] = $j; }
        $anios = array();
        for ($k = 1950; $k <= 2015; $k++){ $anios[$k] = $k; }
        //return $dia;                       
        
        $roles = DB::table('cat_roles')->orderBy('str_rol')->lists('str_rol','id');                       
        $generos = DB::table('cat_datos_maestros')->where('str_tipo','genero')->orderBy('str_descripcion')->lists('str_descripcion','id');
        $paises = DB::table('cat_paises')->orderBy('str_paises')->lists('str_paises','id'); 
        return view('persona.create',compact('roles','generos','paises','dias','meses','anios'))->with('page_title', 'Agregar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'                  => 'required|max:255|unique:tbl_personas',
            'str_nombre'            => 'required|max:255',
            'str_apellido'          => 'required|max:255',
            'lng_idgenero'          => 'required|max:255',
            'dia'                   => 'required|max:255',
            'mes'                   => 'required|max:255',
            'anio'                  => 'required|max:255',
            'str_ididentificacion'  => 'required|max:255|unique:tbl_personas',
            'str_pasaporte'         => 'max:255|unique:tbl_personas',
            'lng_idpais'            => 'required|max:255',
            'password'              => 'required|min:6',
            'email'                 => 'required|email|max:255|unique:tbl_personas',
            'str_telefono'          => 'required|max:255',
            'lng_idrol'             => 'required|max:255',
            'str_twitter'           => 'max:255|unique:tbl_personas',
            'str_facebook'          => 'max:255|unique:tbl_personas',
            'str_instagram'         => 'max:255|unique:tbl_personas',                               
            'blb_img'               => 'image|mimes:jpeg,png',            
        ]);
        $dmt_fecha_nacimiento = $request['anio'] .'-'. $request['mes'] .'-'. $request['dia'];
                
        Persona::create([
            'name'                  => strtolower($request['name']),
            'str_nombre'            => $request['str_nombre'],
            'str_apellido'          => $request['str_apellido'],
            'lng_idgenero'          => $request['lng_idgenero'],
            'dmt_fecha_nacimiento'  => $dmt_fecha_nacimiento,
            'str_ididentificacion'  => $request['str_ididentificacion'],
            'str_pasaporte'         => $request['str_pasaporte'],
            'lng_idpais'            => $request['lng_idpais'],
            'password'              => bcrypt($request['password']),
            'email'                 => $request['email'],
            'str_telefono'          => $request['str_telefono'],
            'lng_idrol'             => $request['lng_idrol'],
            'str_twitter'           => $request['str_twitter'],
            'str_facebook'          => $request['str_facebook'],
            'str_instagram'         => $request['str_instagram'],
            'bol_certificado'       => NULL,
            'bol_eliminado'         => 0,
            'lng_idservicio'        => 152,
            'blb_img'               => base64_encode(file_get_contents($request['blb_img'])),            
        ]);        
        
        Session::flash('message', 'El Usuario &laquo;'. $request['name'] .'&raquo;, ha sido Registrado Exitosamente');        
        return Redirect::route('persona.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $persona= DB::table('tbl_personas')->where('tbl_personas.id', '=',$id)
        ->join('cat_datos_maestros as genero', 'tbl_personas.lng_idgenero', '=', 'genero.id')
        ->join('cat_datos_maestros as servicio', 'tbl_personas.lng_idservicio', '=', 'servicio.id')
        ->join('cat_paises', 'tbl_personas.lng_idpais', '=', 'cat_paises.id')
        ->join('cat_roles', 'tbl_personas.lng_idrol', '=', 'cat_roles.id')        
        ->select(             
            'tbl_personas.id',
            'tbl_personas.name',            
            'tbl_personas.str_nombre', 
            'tbl_personas.str_apellido', 
            'genero.str_descripcion as genero', // Genero 
            'tbl_personas.dmt_fecha_nacimiento', 
            'tbl_personas.str_ididentificacion', 
            'tbl_personas.str_telefono', 
            'tbl_personas.str_pasaporte', 
            'cat_paises.str_paises', // Pais
            'cat_paises.blb_img as bandera', // Bandera
            'tbl_personas.email', 
            'cat_roles.str_rol',  // Rol
            'tbl_personas.str_twitter', 
            'tbl_personas.str_facebook', 
            'tbl_personas.str_instagram', 
            'tbl_personas.bol_certificado', 
            'tbl_personas.bol_eliminado', 
            'servicio.str_descripcion as servicio', // Servicio
            'tbl_personas.blb_img'
            
        )
        ->get(); 
        // return $persona[0]->servicio;

            // Detectando el Tipo de Formato del la Imagen              
            $a = base64_decode($persona[0]->blb_img);
            $b = finfo_open();            
            //Agregando un nuevo atributo al array
            $persona[0]->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);                        
            // Formato Bandera
            $c =  base64_decode($persona[0]->bandera);   
            $persona[0]->format_flag = finfo_buffer($b, $c, FILEINFO_MIME_TYPE);     
        //return $persona;   

        // Formatea la Fecha de Nacimiento         
        $var = explode('-',$persona[0]->dmt_fecha_nacimiento);
        $persona[0]->dmt_fecha_nacimiento = "$var[2]-$var[1]-$var[0]";   

        return view('persona.show',['persona'=>$persona])->with('page_title', 'Consultar');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $persona = Persona::findOrFail($id);        

        // Subtrae de la variable $persona->dmt_fecha_nacimiento el Año-Mes-Dia x separado
        $anio  = substr($persona->dmt_fecha_nacimiento,0,-6); // devuelve el año
        $mes  = substr($persona->dmt_fecha_nacimiento,5,-3); // devuelve el mes
        $dia = substr($persona->dmt_fecha_nacimiento,-2);   // devuelve el dia
        
        // Almacena el Año, Mes y Día en el Array del Usuario a Consultar
        $persona->anio = $anio;
        $persona->mes = $mes;
        $persona->dia = $dia;
        //return $persona->dmt_fecha_nacimiento. ' Año: ' .$anio.' Mes: ' .$mes. ' Dia: ' . $dia;

        // Genera los dias        
        $dias = array();
        for ($i = 1; $i <= 31; $i++){ $dias[$i] = $i; }
        // Genera los Meses
        $meses = array();
        for ($j = 1; $j <= 12; $j++){ $meses[$j] = $j; }
        // Genera los Años
        $anios = array();
        for ($k = 1950; $k <= 2015; $k++){ $anios[$k] = $k; }

        // Detectando el Tipo de Formato del la Imagen              
        $a = base64_decode($persona->blb_img);
        $b = finfo_open();            
        //Agregando un nuevo atributo al array
        $persona->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);
                            
        
        $roles = DB::table('cat_roles')->orderBy('str_rol')->lists('str_rol','id');                       
        $generos = DB::table('cat_datos_maestros')->where('str_tipo','genero')->orderBy('str_descripcion')->lists('str_descripcion','id');
        $paises = DB::table('cat_paises')->orderBy('str_paises')->lists('str_paises','id'); 
        return view('persona.edit',['persona'=>$persona],compact('roles','generos','paises','dias','meses','anios'))->with('page_title', 'Editar');
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
            'name'                  => 'required|max:255|unique:tbl_personas,name,'. $id,
            'str_nombre'            => 'required|max:255',
            'str_apellido'          => 'required|max:255',
            'lng_idgenero'          => 'required|max:255',
            'dia'                   => 'required|max:255',
            'mes'                   => 'required|max:255',
            'anio'                  => 'required|max:255',
            'str_ididentificacion'  => 'required|max:255|unique:tbl_personas,str_ididentificacion,'. $id,
            'str_pasaporte'         => 'max:255|unique:tbl_personas,str_pasaporte,'. $id,
            'lng_idpais'            => 'required|max:255',            
            'email'                 => 'required|email|max:255|unique:tbl_personas,email,'. $id,
            'str_telefono'          => 'required|max:255',
            'lng_idrol'             => 'required|max:255',
            'str_twitter'           => 'max:255|unique:tbl_personas,str_twitter,'. $id,
            'str_facebook'          => 'max:255|unique:tbl_personas,str_facebook,'. $id,
            'str_instagram'         => 'max:255|unique:tbl_personas,str_instagram,'. $id,                               
            'blb_img'               => 'image|mimes:jpeg,png',            
        ]);
        $dmt_fecha_nacimiento = $request['anio'] .'-'. $request['mes'] .'-'. $request['dia'];

        $persona = Persona::find($id);

        if($request['blb_img']==""){            
            $persona->fill($request->all());            
        }else {
            $persona->fill([
                'name'                  => strtolower($request['name']),
                'str_nombre'            => $request['str_nombre'],
                'str_apellido'          => $request['str_apellido'],
                'lng_idgenero'          => $request['lng_idgenero'],
                'dmt_fecha_nacimiento'  => $dmt_fecha_nacimiento,
                'str_ididentificacion'  => $request['str_ididentificacion'],
                'str_pasaporte'         => $request['str_pasaporte'],
                'lng_idpais'            => $request['lng_idpais'],                
                'email'                 => $request['email'],
                'str_telefono'          => $request['str_telefono'],
                'lng_idrol'             => $request['lng_idrol'],
                'str_twitter'           => $request['str_twitter'],
                'str_facebook'          => $request['str_facebook'],
                'str_instagram'         => $request['str_instagram'],                
                'blb_img'               => base64_encode(file_get_contents($request['blb_img'])),
            ]);
        }                 
        $persona->save();

             
        Session::flash('message', 'El Usuario &laquo;'. $request['name'] .'&raquo;, ha sido Registrado Exitosamente');        
        return Redirect::route('persona.edit',$id);
    }

    public function status($id)
    {        
        $persona = Persona::findOrFail($id);    
        // Detectando el Tipo de Formato del la Imagen              
        $a = base64_decode($persona->blb_img);
        $b = finfo_open();            
        //Agregando un nuevo atributo al array
        $persona->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);              
        return view('persona.status',['persona'=>$persona])->with('page_title', 'Estado');
    }

    public function statusChange($id, Request $request)
    {
        $this->validate($request, [
            'bol_eliminado'         => 'required|boolean',            
        ]);             
        $persona = Persona::find($id);
        $persona->fill($request->all());
        $persona->save();
        Session::flash('message', 'El Usuario ha cambiado de Estado');
        return Redirect::route('persona.status',$id);       
    }

    public function certificate($id)
    {        
        $persona = Persona::findOrFail($id);    
        // Detectando el Tipo de Formato del la Imagen              
        $a = base64_decode($persona->blb_img);
        $b = finfo_open();            
        //Agregando un nuevo atributo al array
        $persona->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);              
        return view('persona.certificate',['persona'=>$persona])->with('page_title', 'Certificado');
    }

    public function certificateChange($id, Request $request)
    {
        $this->validate($request, [
            'bol_certificado'         => 'required|boolean',            
        ]);             
        $persona = Persona::find($id);
        $persona->fill($request->all());
        $persona->save();
        Session::flash('message', 'El Usuario ha cambiado el Estado del Certificado');
        return Redirect::route('persona.certificate',$id);       
    }

    public function delete($id){                   
        $persona = Persona::findOrFail($id);    
        // Detectando el Tipo de Formato del la Imagen              
        $a = base64_decode($persona->blb_img);
        $b = finfo_open();            
        //Agregando un nuevo atributo al array
        $persona->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);
        return view('persona.delete',['persona'=>$persona])->with('page_title', 'Eliminar');                            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Persona::destroy($id);
        Session::flash('message', 'Usuario Eliminado Exitosamente');
        return Redirect::route('persona.index',$id);
    }

    public function reset($id)
    { 
        $persona = Persona::findOrFail($id);    
        // Detectando el Tipo de Formato del la Imagen              
        $a = base64_decode($persona->blb_img);
        $b = finfo_open();            
        //Agregando un nuevo atributo al array
        $persona->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);        
        return view('persona.reset',['persona'=>$persona])->with('page_title', 'Reset Password');                    
    }

    public function resetChange($id, Request $request)
    {
        $this->validate($request, [
            'bol_eliminado' => 'required|boolean',            
            'password'      => 'required',
        ]); 

        $request['bol_eliminado'] = 1;
        $request['password'] = '';        
        $persona = Persona::find($id);
        $persona->fill($request->all());
        $persona->save();
        Session::flash('message', 'Password Reseteado de manera Exitosa');
        return Redirect::route('persona.reset',$id);
               
    }

    public function generate($id){                   
        $persona = Persona::findOrFail($id);    
        // Detectando el Tipo de Formato del la Imagen              
        $a = base64_decode($persona->blb_img);
        $b = finfo_open();            
        //Agregando un nuevo atributo al array
        $persona->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);        
        return view('persona.generate',['persona'=>$persona])->with('page_title', 'Generar Password');                    
    }

    public function generatePassword($id, Request $request)
    {
        
        $this->validate($request, [
            'bol_eliminado' => 'required|boolean',            
            'password'      => 'required|confirmed|min:6',
        ]); 

        $request['bol_eliminado'] = 0;
        $request['password'] = bcrypt($request['password']);        
        $persona = Persona::find($id);
        $persona->fill($request->all());
        $persona->save();
        Session::flash('message', 'Password Generado de manera Exitosa');
        return Redirect::route('persona.generate',$id);
               
    }
}

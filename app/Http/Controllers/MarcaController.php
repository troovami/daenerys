<?php

namespace Troovami\Http\Controllers;

use Illuminate\Http\Request;

use Troovami\Http\Requests;
use Troovami\Http\Controllers\Controller;
use Troovami\Marca;
use Session;
use Redirect;
use DB;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $marcas= DB::table('cat_marcas')
        ->join('cat_datos_maestros', 'cat_marcas.lng_idtipo', '=', 'cat_datos_maestros.id')
        ->select(
            'cat_datos_maestros.str_tipo', 
            'cat_marcas.id',
            'cat_marcas.str_marca',            
            'cat_marcas.bol_eliminado',
            'cat_marcas.blb_img'
                )
        ->get();                
        
        foreach ($marcas as $key => $value) {                    
            // Detectando el Tipo de Formato del la Imagen              
            $a = base64_decode($value->blb_img);
            $b = finfo_open();            
            //Agregando un nuevo atributo al array
            $value->type = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);          
        }  
        return view('marca.marca',compact('marcas'))->with('page_title', 'Principal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tipo = DB::table('cat_datos_maestros')->whereIn('str_tipo',['mobile','vehiculos'])->orderBy('str_tipo')->lists('str_tipo','id');
        //return $tipo;
        return view('marca.create',compact('tipo'))->with('page_title', 'Agregar');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [                 
            'str_marca'            => 'required|unique:cat_marcas',
            'str_friendly_url'     => 'required|unique:cat_marcas', 
            'str_meta_descripcion' => 'required|max:255',
            'str_meta_keyword'     => 'required|max:255',
            'str_website'          => 'required|max:255|url',
            'lng_idtipo'           => 'required',            
            'blb_img'              => 'required|mimes:jpeg,png',
        ]);

        Marca::create([
            'str_marca'         => ucfirst(strtolower($request['str_paises'])),
            'str_friendly_url'  => $request['str_paises'],
            'blb_img'         => base64_encode(file_get_contents($request['blb_img'])),
        ]);     
        Session::flash('message', 'El Pais(a) &laquo;'. $request['str_paises'] .'&raquo;, ha sido Registrado Exitosamente');        
        return Redirect::route('pais.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace Troovami\Http\Controllers;

use Illuminate\Http\Request;

use Troovami\Http\Requests;
use Troovami\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Troovami\Maestro;
use Troovami\Modelo;
use Troovami\Marca;
use Troovami\User;
use Session;
use Redirect;
use DB;

class ModeloController extends Controller
{
    public function index()
    {   
       $filtro= 154; // id Moviles        

       $modelos= DB::table('tbl_modelos')        
        ->where('lng_idtipo_equipo',[$filtro])
        ->join('cat_marcas', 'tbl_modelos.lng_idmarca', '=', 'cat_marcas.id')
        ->select(            
            'tbl_modelos.*',
            'cat_marcas.str_marca'                                    
                )         
        ->get();

        return view('modelo.modelo',['modelos'=>$modelos])->with('page_title', 'Principal');
    }

   
    public function create()
    {
        $marcas= DB::table('cat_marcas')
        ->where('tbl_tipos_marcas.lng_idtipo','=',154)
        ->join('tbl_tipos_marcas', 'cat_marcas.id', '=', 'tbl_tipos_marcas.lng_idmarca')
        ->select(
            'cat_marcas.str_marca as nombre_marca',
            'cat_marcas.id as id_marca'
            )
        ->lists('nombre_marca','id_marca');

        $gama= DB::table('cat_datos_maestros')
        ->where('cat_datos_maestros.str_tipo', '=' , 'gama')
        ->select(
            'cat_datos_maestros.str_descripcion as gama',
            'cat_datos_maestros.id as id_gama'
        )
        ->distinct()
        ->lists('gama','id_gama');

        $clasificacion= DB::table('cat_datos_maestros')
        ->where('cat_datos_maestros.str_tipo', '=' , 'modelo')
        ->select(
            'cat_datos_maestros.str_descripcion as modelo',
            'cat_datos_maestros.id as id_modelo'
        )
        ->distinct()
        ->lists('modelo','id_modelo');

        return view('modelo.create',compact('marcas','gama','clasificacion'))->with('page_title', 'Agregar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $id_admin = Auth::id();
        $this->validate($request, [
             'str_modelo'         => 'required|unique:tbl_modelos',            
        ]);   
             
        Modelo::create([
            'str_modelo'            => ucfirst(strtolower($request['str_modelo'])),
            'lng_idmarca'           => $request['lng_idmarca'],
            'lng_idclasificacion'   => $request['lng_idclasificacion'],
            'lng_idgama'            => $request['lng_idgama'],
            'lng_idtipo_equipo'     => 154,
            'lng_idadmin'           => $id_admin,
            'bol_eliminado'         => 0,
        ]);     
        Session::flash('message', 'El Modelo &laquo;'. $request['str_modelo'] .'&raquo;, ha sido Registrado Exitosamente');        
        return Redirect::route('modelo.create');
    }
    
    public function show($id)
    {
        $modelo = Modelo::findOrFail($id);
        $marca = Marca::findOrFail($modelo->lng_idmarca);
        $clasificacion = Maestro::findOrFail($modelo->lng_idclasificacion);
        $gama = Maestro::findOrFail($modelo->lng_idgama);

        return view('modelo.show',['modelo'=>$modelo,'marca'=>$marca,'clasificacion'=>$clasificacion,'gama'=>$gama])->with('page_title', 'Consultar');
    }

    public function edit($id)
    {   
        $modelo = Modelo::findOrFail($id);
        $marcas= DB::table('cat_marcas')
        ->where('tbl_tipos_marcas.lng_idtipo','=',154)
        ->join('tbl_tipos_marcas', 'cat_marcas.id', '=', 'tbl_tipos_marcas.lng_idmarca')
        ->select(
            'cat_marcas.str_marca as nombre_marca',
            'cat_marcas.id as id_marca'
            )
        ->lists('nombre_marca','id_marca');

        $gama= DB::table('cat_datos_maestros')
        ->where('cat_datos_maestros.str_tipo', '=' , 'gama')
        ->select(
            'cat_datos_maestros.str_descripcion as gama',
            'cat_datos_maestros.id as id_gama'
        )
        ->distinct()
        ->lists('gama','id_gama');

        $clasificacion= DB::table('cat_datos_maestros')
        ->where('cat_datos_maestros.str_tipo', '=' , 'modelo')
        ->select(
            'cat_datos_maestros.str_descripcion as modelo',
            'cat_datos_maestros.id as id_modelo'
        )
        ->distinct()
        ->lists('modelo','id_modelo');

        return view('modelo.edit',['modelo'=>$modelo,'clasificacion'=>$clasificacion,'gama'=>$gama,'marcas'=>$marcas])->with('page_title', 'Editar');
    }

    public function update($id, Request $request)
    {
        
        $this->validate($request, [
            'str_modelo'         => 'required|max:255|unique:tbl_modelos,str_modelo,'.$id,           
        ]); 
        $modelo = Modelo::find($id);
        $modelo->fill($request->all());
        $modelo->save();
        Session::flash('message', 'Modelo Actualizado Exitosamente');
        return Redirect::route('modelo.edit',$id);
    }

    public function status($id)
    {        
        $modelo = Modelo::findOrFail($id);           
        return view('modelo.status',['modelo'=>$modelo])->with('page_title', 'Estado');
    }

    public function statusChange($id, Request $request)
    {
        $modelo = Modelo::find($id);
        $modelo->fill($request->all());
        $modelo->save();
        Session::flash('message', 'El Modelo ha cambiado de Estado');
        return Redirect::route('modelo.status',$id);       
    }

    public function delete($id)
    {                   
        $modelo = Modelo::findOrFail($id);           
        return view('modelo.delete',['modelo'=>$modelo])->with('page_title', 'Eliminar');                  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Modelo::destroy($id);
        Session::flash('message', 'Modelo Eliminado Exitosamente');
        return Redirect::route('modelo.index');
    }
}


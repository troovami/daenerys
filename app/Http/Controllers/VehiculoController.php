<?php

namespace Troovami\Http\Controllers;

use Illuminate\Http\Request;

use Troovami\Http\Requests;
use Troovami\Http\Controllers\Controller;
use Troovami\Vehiculo;
use Troovami\DetalleVehiculo;
use Troovami\ImagenesVehiculos;
use Session;
use Redirect;
use DB;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function publicacionesActivas()
    {
        $vehiculos= DB::table('tbl_vehiculos as publicaciones')
        ->where('publicaciones.bol_eliminado','=',0)
        ->join('cat_datos_maestros as vehiculos', 'publicaciones.lng_idtipo_vehiculo', '=', 'vehiculos.id') // TIPO VEHICULO
        ->join('cat_paises as paises', 'publicaciones.lng_idpais', '=', 'paises.id') // PAIS
        ->join('tbl_personas as personas', 'publicaciones.lng_idpersona', '=', 'personas.id') // Persona
        ->join('tbl_modelos as modelos', 'publicaciones.lng_idmodelo', '=', 'modelos.id') // PAIS
        ->join('cat_marcas as marcas', 'modelos.lng_idmarca', '=', 'marcas.id') // PAIS
        ->select(
            'vehiculos.str_descripcion as clasificacion',  // Clasificacion
            'vehiculos.str_tipo as vehiculo',  // Vehiculo
            'paises.str_paises as pais',  // PAIS
            'personas.name',  // name
            //'paises.blb_img as blb_img', // IMAGEN PAIS            
            'publicaciones.id',
            'modelos.str_modelo',            
            'marcas.str_marca', 
            'publicaciones.bol_eliminado'
            )
        ->get();         
        
        
        return view('vehiculo.publicaciones-activas',compact('vehiculos'))->with('page_title', 'Publicaciones Activas');
    }

    public function publicacionesInactivas()
    {
        $vehiculos= DB::table('tbl_vehiculos as publicaciones')
        ->where('publicaciones.bol_eliminado','=',1)
        ->join('cat_datos_maestros as vehiculos', 'publicaciones.lng_idtipo_vehiculo', '=', 'vehiculos.id') // TIPO VEHICULO
        ->join('cat_paises as paises', 'publicaciones.lng_idpais', '=', 'paises.id') // PAIS
        ->join('tbl_personas as personas', 'publicaciones.lng_idpersona', '=', 'personas.id') // Persona
        ->join('tbl_modelos as modelos', 'publicaciones.lng_idmodelo', '=', 'modelos.id') // PAIS
        ->join('cat_marcas as marcas', 'modelos.lng_idmarca', '=', 'marcas.id') // PAIS
        ->select(
            'vehiculos.str_descripcion as clasificacion',  // Clasificacion
            'vehiculos.str_tipo as vehiculo',  // Vehiculo
            'paises.str_paises as pais',  // PAIS
            'personas.name',  // name
            //'paises.blb_img as blb_img', // IMAGEN PAIS            
            'publicaciones.id',
            'modelos.str_modelo',            
            'marcas.str_marca', 
            'publicaciones.bol_eliminado'
            )
        ->get();         
        
        
        return view('vehiculo.publicaciones-inactivas',compact('vehiculos'))->with('page_title', 'Publicaciones Inactivas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
        // Consulta la tabla Marcas 
        //$vehiculo = Vehiculo::findOrFail($id);
        //$vehiculo = DB::table('tbl_vehiculos')->where('id','=',$id)->get();
        $vehiculo= DB::table('tbl_vehiculos as publicacion')
        ->where('publicacion.id','=',$id)
        ///////////////////////////////////////////////////////////////////////////////////////////////////
        // JOIN DATOS PERSONA
        ->join('tbl_personas as persona', 'publicacion.lng_idpersona', '=', 'persona.id') // Datos Persona
        ->join('cat_datos_maestros as genero', 'persona.lng_idgenero', '=', 'genero.id') // Genero Persona
        ->join('cat_paises as pais_persona', 'persona.lng_idpais', '=', 'pais_persona.id') // Pais Persona
        ->join('cat_datos_maestros as servicio', 'persona.lng_idservicio', '=', 'servicio.id') // Servicio en donde se Registro
        ///////////////////////////////////////////////////////////////////////////////////////////////////
        //->join('cat_datos_maestros as vehiculo', 'publicaciones.lng_idtipo_vehiculo', '=', 'vehiculos.id') // TIPO VEHICULO
        //->join('cat_paises as paises', 'publicaciones.lng_idpais', '=', 'paises.id') // PAIS VEHICULO PUBLICADO
        
        //->join('tbl_modelos as modelos', 'publicaciones.lng_idmodelo', '=', 'modelos.id') // PAIS
        //->join('cat_marcas as marcas', 'modelos.lng_idmarca', '=', 'marcas.id') // PAIS
        ->select(
            'persona.name',                                 // Nickname de la Persona
            'persona.str_nombre as nombre',                 // Nombre de la Persona
            'persona.str_apellido as apellido',             // Apellido de la Persona
            'persona.email',                                // Email de la Persona
            'persona.bol_eliminado as status_persona',      // Estatus de la Persona
            'persona.created_at',                           // Creacion de la Cuenta
            'persona.updated_at',                           // Ultima Entrada Sesion
            //'persona.lng_idgenero',                       // id Genero de la Persona
            'genero.str_descripcion as genero',             // Genero  de la Persona
            'pais_persona.str_paises as pais_persona',       // Pais  de la Persona
            'servicio.str_descripcion as servicio-persona' // Servicio en donde se Registro la Persona
            //'vehiculos.str_descripcion as clasificacion',  // Clasificacion
            //'vehiculos.str_tipo as vehiculo',  // Vehiculo
            //'paises.str_paises as pais',  // PAIS
            //'personas.name',  // name
            //'paises.blb_img as blb_img', // IMAGEN PAIS            
            //'publicaciones.id',
            //'modelos.str_modelo',            
            //'marcas.str_marca', 
            //'publicaciones.bol_eliminado'
            )
        ->get();  
        return $vehiculo;
        //return $vehiculo[0]->name;
        /*
        $ImagenesVehiculo = DB::table('tbl_imagenes_vehiculos')->where('lng_idvehiculo','=',$id)->get();
        return $ImagenesVehiculo;
        $DetalleVehiculo = DB::table('tbl_detalles_vehiculos')->where('lng_idvehiculo','=',$id)->get();
        return $DetalleVehiculo;
        */
        //return count($DetalleVehiculo);
        //$ImagenesVehiculos = ImagenesVehiculos::findOrFail($id);
        /*
        $a = base64_decode($marca->blb_img);
        $b = finfo_open(); 
        $marca->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);
        // Consulta los Tipos Asociados a la Marca       
        $tipos= DB::table('tbl_tipos_marcas')        
        ->where('lng_idmarca',$id)
        ->join('cat_datos_maestros', 'tbl_tipos_marcas.lng_idtipo', '=', 'cat_datos_maestros.id')
        ->select(            
            'cat_datos_maestros.str_descripcion'                                    
                )         
        ->get();    
                  
        return view('marca.show',['marca'=>$marca,'tipos'=>$tipos])->with('page_title', 'Consultar');
        */
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

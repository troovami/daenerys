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
        //->orderBy('id')
        // PERSONAS      
        ->join('tbl_personas as persona', 'publicaciones.lng_idpersona', '=', 'persona.id')
        // TIPOS VEHICULOS
        ->join('cat_datos_maestros as tipo_vehiculo', 'publicaciones.lng_idtipo_vehiculo', '=', 'tipo_vehiculo.id')
        // CLASIFICACIONES
        ->join('cat_datos_maestros as clasificacion', 'publicaciones.lng_idsubtipo_vehiculo', '=', 'clasificacion.id')         
        // MODELOS
        ->join('tbl_modelos as modelo', 'publicaciones.lng_idmodelo', '=', 'modelo.id')
        // MARCAS
        ->join('cat_marcas as marca', 'modelo.lng_idmarca', '=', 'marca.id')        
        // PAISES
        ->join('cat_paises as pais', 'publicaciones.lng_idpais', '=', 'pais.id')
        ->select(
            // ID - Publicaciones
            'publicaciones.id',
            // Usuarios - Publicaciones
            'persona.name',
            // Tipos - Vehiculo
            'tipo_vehiculo.str_descripcion as tipo_vehiculo',  
            // Clasificaciones - Vehiculos
            'clasificacion.str_descripcion as clasificacion',
            // Modelos - Vehiculos
            'marca.str_marca as marca',
            // Modelos - Vehiculos
            'modelo.str_modelo as modelo',            
            // Paises  - Publicaciones
            'pais.str_paises as pais'
            )
        ->get();         
        
        //return $vehiculos[0]->marca;
        //return $vehiculos;
        return view('vehiculo.publicaciones-activas',compact('vehiculos'))->with('page_title', 'Publicaciones Activas');
    }

    public function publicacionesInactivas()
    {
        $vehiculos= DB::table('tbl_vehiculos as publicaciones')
        ->where('publicaciones.bol_eliminado','=',1)
        //->orderBy('id')
        // PERSONAS      
        ->join('tbl_personas as persona', 'publicaciones.lng_idpersona', '=', 'persona.id')
        // TIPOS VEHICULOS
        ->join('cat_datos_maestros as tipo_vehiculo', 'publicaciones.lng_idtipo_vehiculo', '=', 'tipo_vehiculo.id')
        // CLASIFICACIONES
        ->join('cat_datos_maestros as clasificacion', 'publicaciones.lng_idsubtipo_vehiculo', '=', 'clasificacion.id')         
        // MODELOS
        ->join('tbl_modelos as modelo', 'publicaciones.lng_idmodelo', '=', 'modelo.id')
        // MARCAS
        ->join('cat_marcas as marca', 'modelo.lng_idmarca', '=', 'marca.id')        
        // PAISES
        ->join('cat_paises as pais', 'publicaciones.lng_idpais', '=', 'pais.id')
        ->select(
            // ID - Publicaciones
            'publicaciones.id',
            // Usuarios - Publicaciones
            'persona.name',
            // Tipos - Vehiculo
            'tipo_vehiculo.str_descripcion as tipo_vehiculo',  
            // Clasificaciones - Vehiculos
            'clasificacion.str_descripcion as clasificacion',
            // Modelos - Vehiculos
            'marca.str_marca as marca',
            // Modelos - Vehiculos
            'modelo.str_modelo as modelo',            
            // Paises  - Publicaciones
            'pais.str_paises as pais'
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
        //$data = DB::table('tbl_vehiculos as publicacion')->where('publicacion.id','=',$id)->get();        
        $vehiculo= DB::table('tbl_vehiculos as publicacion')
        ->where('publicacion.id','=',$id)        
        ///////////////////////////////////////////////////////////////////////////////////////////////////
        // JOINS DATOS PERSONA
        ///////////////////////////////////////////////////////////////////////////////////////////////////
        ->join('tbl_personas as persona', 'publicacion.lng_idpersona', '=', 'persona.id') // Datos Persona
        ->join('cat_datos_maestros as genero', 'persona.lng_idgenero', '=', 'genero.id') // Genero Persona
        ->join('cat_paises as pais_persona', 'persona.lng_idpais', '=', 'pais_persona.id') // Pais Persona
        ->join('cat_datos_maestros as servicio', 'persona.lng_idservicio', '=', 'servicio.id') // Servicio en donde se Registro
        ///////////////////////////////////////////////////////////////////////////////////////////////////
        // JOINS DATOS VEHICULO
        ///////////////////////////////////////////////////////////////////////////////////////////////////
        // TIPO VEHICULO
        ->join('cat_datos_maestros as tipo_vehiculo', 'publicacion.lng_idtipo_vehiculo', '=', 'tipo_vehiculo.id')
        // CLASIFICACION
        ->join('cat_datos_maestros as clasificacion', 'publicacion.lng_idsubtipo_vehiculo', '=', 'clasificacion.id')         
        // MODELO
        ->join('tbl_modelos as modelo', 'publicacion.lng_idmodelo', '=', 'modelo.id')
        // MARCAS
        ->join('cat_marcas as marca', 'modelo.lng_idmarca', '=', 'marca.id')        
        // PAISES
        ->join('cat_paises as pais', 'publicacion.lng_idpais', '=', 'pais.id')  
        // CILINDRADA
        ->join('cat_datos_maestros as cilindrada', 'publicacion.lng_idcilindrada', '=', 'cilindrada.id')
        // ARRANQUE
        ->leftjoin('cat_datos_maestros as arranque', 'publicacion.lng_idarranque', '=', 'arranque.id')
        // DIRECCION
        ->join('cat_datos_maestros as direccion', 'publicacion.lng_iddireccion', '=', 'direccion.id')
        // ESTEREO
        ->join('cat_datos_maestros as estereo', 'publicacion.lng_idestereo', '=', 'estereo.id')
        // TRANSMISION
        ->join('cat_datos_maestros as transmision', 'publicacion.lng_idtransmision', '=', 'transmision.id')
        // EQUIPO MEDICO
        ->leftjoin('cat_datos_maestros as equipo_medico', 'publicacion.lng_idequipo_medico', '=', 'equipo_medico.id')        

                
        /*    
        
        
            int_pisos
            int_alto
            int_ancho
            str_carroceria
            lng_idfrenado
         */     
        ///////////////////////////////////////////////////////////////////////////////////////////////////
        //->join('cat_datos_maestros as vehiculo', 'publicaciones.lng_idtipo_vehiculo', '=', 'vehiculos.id') // TIPO VEHICULO
        //->join('cat_paises as paises', 'publicaciones.lng_idpais', '=', 'paises.id') // PAIS VEHICULO PUBLICADO
        
        //->join('tbl_modelos as modelos', 'publicaciones.lng_idmodelo', '=', 'modelos.id') // PAIS
        //->join('cat_marcas as marcas', 'modelos.lng_idmarca', '=', 'marcas.id') // PAIS
        ->select(
            // DATOS PERSONA
            'persona.name',                                 // Nickname de la Persona
            'persona.str_nombre as nombre',                 // Nombre de la Persona
            'persona.str_apellido as apellido',             // Apellido de la Persona
            'persona.email',                                // Email de la Persona
            'persona.bol_eliminado as status_persona',      // Estatus de la Persona
            'persona.created_at',                           // Creacion de la Cuenta
            'persona.updated_at',                           // Ultima Entrada Sesion
            //'persona.lng_idgenero',                       // id Genero de la Persona
            'genero.str_descripcion as genero',             // Genero  de la Persona
            'pais_persona.str_paises as pais_persona',      // Pais  de la Persona
            //'pais_persona.blb_img as pais_imagen_persona',  // Pais Imagen de la Persona
            'servicio.str_descripcion as servicio_persona',  // Servicio en donde se Registro la Persona
            //'persona.blb_img as imagen-persona',            // Imagen Persona
            // Tipos - Vehiculo
            'tipo_vehiculo.str_descripcion as v_tipo',  
            // Clasificaciones - Vehiculos
            'clasificacion.str_descripcion as v_clasificacion',
            // Modelos - Vehiculos
            'marca.str_marca as v_marca',
            // Modelos - Vehiculos
            'modelo.str_modelo as v_modelo',            
            // Paises  - Publicaciones
            'pais.str_paises as v_pais',
            // Placa - Vehiculo
            'publicacion.str_placa as v_placa',
            // cilindrada - Vehiculo
            'cilindrada.str_descripcion as v_cilindrada',
            // Cilindros - Vehiculo
            'publicacion.int_cilindros as v_cilindros',
            // Año - Vehiculo
            'publicacion.int_ano as v_anio',
            // Arranque - Vehiculo
            'arranque.str_descripcion as v_arranque',
            // Direccion - Vehiculo
            'direccion.str_descripcion as v_direccion',
            // Estereo - Vehiculo
            'estereo.str_descripcion as v_estereo',
            // Transmision - Vehiculo
            'transmision.str_descripcion as v_transmision',
            // Equipo Medico - Vehiculo
            'equipo_medico.str_descripcion as v_equipo_medico',
            // Pisos - Vehiculo
            'publicacion.int_pisos as v_pisos',
            // Alto - Vehiculo
            'publicacion.int_alto as v_alto',
            // Ancho - Vehiculo
            'publicacion.int_ancho as v_ancho'

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

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
    public function index()
    {
        
        
        $vehiculos= DB::table('tbl_vehiculos')
        ->join('tbl_personas as personas', 'tbl_vehiculos.lng_idpersona', '=', 'personas.id') // PERSONA        
        ->join('cat_datos_maestros as vehiculos', 'tbl_vehiculos.lng_idtipo_vehiculo', '=', 'vehiculos.id') // TIPO VEHICULO
        ->join('tbl_modelos as modelos', 'tbl_vehiculos.lng_idmodelo', '=', 'modelos.id') // MODELO
        ->join('cat_datos_maestros as direccion_vehiculos', 'tbl_vehiculos.lng_iddireccion', '=', 'direccion_vehiculos.id') // DIRECCION VEHICULO
        ->join('cat_datos_maestros as estereo_vehiculos', 'tbl_vehiculos.lng_idestereo', '=', 'estereo_vehiculos.id') // ESTEREO VEHICULO
        ->join('cat_datos_maestros as transmision_vehiculos', 'tbl_vehiculos.lng_idtransmision', '=', 'transmision_vehiculos.id') // TRANSMISION VEHICULO
        ->join('cat_datos_maestros as equipomedico_vehiculos', 'tbl_vehiculos.lng_idequipo_medico', '=', 'equipomedico_vehiculos.id') // EQUIPO MEDICO VEHICULO
        ->join('cat_datos_maestros as frenado_vehiculos', 'tbl_vehiculos.lng_idfrenado', '=', 'frenado_vehiculos.id') // FRENADO VEHICULO
        ->join('cat_datos_maestros as respuestas', 'tbl_vehiculos.lng_idnegociable', '=', 'respuestas.id') // RESPUESTA
        ->join('cat_datos_maestros as traccion_vehiculos', 'tbl_vehiculos.lng_idtraccion', '=', 'traccion_vehiculos.id') // TRACCION VEHICULO
        ->join('cat_datos_maestros as tapizado_vehiculos', 'tbl_vehiculos.lng_idtapizado', '=', 'tapizado_vehiculos.id') // TAPIZADO VEHICULO
        ->join('cat_datos_maestros as motor_reparado_vehiculos', 'tbl_vehiculos.lng_idmotorreparado', '=', 'motor_reparado_vehiculos.id') // MOTOR REPARADO VEHICULO
        ->join('cat_datos_maestros as vidrios_vehiculos', 'tbl_vehiculos.lng_idvidrios', '=', 'vidrios_vehiculos.id') // VIDRIO VEHICULO
        ->join('cat_datos_maestros as colores', 'tbl_vehiculos.lng_idcolor', '=', 'colores.id') // COLOR VEHICULO
        ->join('cat_datos_maestros as combustible_vehiculos', 'tbl_vehiculos.lng_idcombustible', '=', 'combustible_vehiculos.id') // COMBUSTIBLE VEHICULO
        ->join('cat_datos_maestros as unico_dueno', 'tbl_vehiculos.lng_idunicodueno', '=', 'unico_dueno.id') // UNICO DUEÑO VEHICULO
        //->join('cat_datos_maestros as tipo_motor', 'tbl_vehiculos.lng_idtipomotor', '=', 'tipo_motor.id') // TIPO MOTOR VEHICULO
        ->join('cat_datos_maestros as financiamiento', 'tbl_vehiculos.lng_idfinanciamiento', '=', 'financiamiento.id') // FINANCIAMIENTO VEHICULO
        ->join('cat_datos_maestros as chocado', 'tbl_vehiculos.lng_idchocado', '=', 'chocado.id') // CHOCADO VEHICULO
        ->join('tbl_imagenes_vehiculos as imagenes_vehiculos', 'tbl_vehiculos.id', '=', 'imagenes_vehiculos.lng_idvehiculo') // IMAGENES VEHICULO
        ->select(
            'personas.name as persona',                                           // PERSONA
            'vehiculos.str_descripcion as tipo_vehiculo',                         // TIPO VEHICULO
            'modelos.str_modelo as modelo',                                       // MODELOS
            'direccion_vehiculos.str_descripcion as direccion_vehiculo',          // DIRECCION VEHICULO    
            'estereo_vehiculos.str_descripcion as estereo_vehiculo',              // ESTEREO VEHICULO        
            'transmision_vehiculos.str_descripcion as transmision_vehiculo',      // TRANSMISION VEHICULO
            'equipomedico_vehiculos.str_descripcion as equipomedico_vehiculo',    // EQUIPO MEDICO VEHICULO          
            'frenado_vehiculos.str_descripcion as frenado_vehiculo',              // FRENADO VEHICULO
            'respuestas.str_descripcion as respuesta',                            // FRENADO VEHICULO
            'traccion_vehiculos.str_descripcion as traccion_vehiculo',            // FRENADO VEHICULO
            'tapizado_vehiculos.str_descripcion as tapizado_vehiculo',            // TAPIZADO VEHICULO
            'motor_reparado_vehiculos.str_descripcion as motor_reparado_vehiculo',// MOTOR REPARADO VEHICULO
            'vidrios_vehiculos.str_descripcion as vidrios_vehiculo',              // VIDRIO VEHICULO
            'colores.str_descripcion as color',                                   // COLOR VEHICULO
            'colores.str_caracteristica as color_web',                            // COLOR WEB VEHICULO
            'combustible_vehiculos.str_descripcion as combustible_vehiculo',      // COMBUSTIBLE VEHICULO
            'unico_dueno.str_descripcion as unico_dueno',                         // UNICO DUEÑO VEHICULO
            //'tipo_motor.str_descripcion as tipo_motor',                         // TIPO MOTOR VEHICULO
            'financiamiento.str_descripcion as financiamiento',                   // FINANCIAMIENTO VEHICULO
            'chocado.str_descripcion as chocado',                                 // CHOCADO VEHICULO
            'imagenes_vehiculos.str_descripcion as imagenes_vehiculos',           // IMAGENES VEHICULO
            //'cat_paises.str_paises as pais',    // PAIS            
            'tbl_vehiculos.id',
            //'tbl_vehiculos.lng_idpersona', // cambiar id           
            //'tbl_vehiculos.lng_idtipo_vehiculo', // cambiar id    
            'tbl_vehiculos.str_placa',
            //'tbl_vehiculos.lng_idmodelo', // id
            'tbl_vehiculos.str_cilindrada',            
            'tbl_vehiculos.int_cilindros', 
            'tbl_vehiculos.int_ano', 
            //'tbl_vehiculos.lng_iddireccion', // id
            //'tbl_vehiculos.lng_idestereo',  // id
            //'tbl_vehiculos.lng_idtransmision', // id
            //'tbl_vehiculos.lng_idequipo_medico', // id
            'tbl_vehiculos.int_pisos', 
            'tbl_vehiculos.str_carroceria', 
            //'tbl_vehiculos.lng_idfrenado', // id
            'tbl_vehiculos.int_carga', 
            'tbl_vehiculos.int_lastre', 
            'tbl_vehiculos.dbl_neumatico', 
            'tbl_vehiculos.int_potenciamax', 
            'tbl_vehiculos.int_pasajeros', 
            'tbl_vehiculos.int_horasuso', 
            'tbl_vehiculos.str_comentario', 
            //'tbl_vehiculos.lng_idnegociable', // id
            //'tbl_vehiculos.lng_idtraccion', // id
            //'tbl_vehiculos.lng_idtapizado', // id
            //'tbl_vehiculos.lng_idmotorreparado', // id
            //'tbl_vehiculos.lng_idvidrios', // id
            'tbl_vehiculos.int_cantidad_puertas', 
            //'tbl_vehiculos.lng_idcolor', // id
            //'tbl_vehiculos.lng_idcombustible', // id
            //'tbl_vehiculos.lng_idunicodueno', // id
            'tbl_vehiculos.str_recorrido',
            'tbl_vehiculos.str_version',
            //'tbl_vehiculos.lng_idtipomotor', // id
            //'tbl_vehiculos.lng_idfinanciamiento', // id
            //'tbl_vehiculos.lng_idchocado', // id
            'tbl_vehiculos.lng_idrecibomoto', // id
            'tbl_vehiculos.lng_idsistemaarranque', // id
            'tbl_vehiculos.dmt_fecha_publicacion_fin',
            'tbl_vehiculos.dmt_fecha_publicacion',
            'tbl_vehiculos.bol_eliminado',
            'tbl_vehiculos.bol_activa',
            'tbl_vehiculos.int_esloralargo',
            'tbl_vehiculos.int_mangaancho',
            'tbl_vehiculos.lng_idmaxtripulantes', // id
            'tbl_vehiculos.lng_idmaterial', // id
            'tbl_vehiculos.int_peso',
            'tbl_vehiculos.int_potenciamax',
            'tbl_vehiculos.str_precio_venta',
            'tbl_vehiculos.str_moneda',
            'tbl_vehiculos.lng_idpais', // id
            'tbl_vehiculos.str_video',
            'tbl_vehiculos.updated_at',
            'tbl_vehiculos.created_at',
            'tbl_vehiculos.status_admin',
            'tbl_vehiculos.status_user',
            'tbl_vehiculos.lng_idbano', // id
            'tbl_vehiculos.lng_idventana' // id
                )
        ->get(); 
        //return $vehiculos;
        
        foreach ($vehiculos as $key => $value) {                                
            $value->str_placa = strtoupper($value->str_placa);           
        }
        //return $vehiculos[0]->str_placa;
        //return $vehiculos;
        return view('vehiculo.vehiculo',compact('vehiculos'))->with('page_title', 'Principal');
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

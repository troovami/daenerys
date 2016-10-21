<?php

namespace Troovami\Http\Controllers;

use Illuminate\Http\Request;

use Troovami\Http\Controllers\Controller;
use Troovami\Vehiculo;
use Troovami\DetalleVehiculo;
use Troovami\ImagenesVehiculos;
use Session;
use Redirect;
use DB;
use Illuminate\Support\Facades\Auth;

class OperadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function revision()
    {
    	$id = Auth::user()->id;
    	$idrol = Auth::user()->lng_idrol;
    	if($idrol == 1 or $idrol == 3)
    	{
    	 	$campo = 'publicaciones.lng_idadmin';
    	}
    	elseif($idrol == 4)
    	{
    		$campo = 'publicaciones.lng_idoper';
    	}
    		$revisiones= DB::table('tbl_vehiculos as publicaciones')
    		->where('publicaciones.bol_eliminado','=',0)
    		->where('publicaciones.status_admin','=',710)
    		->where($campo, '=' , $id)
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
    		// ADMINISTRADOR
    		->leftjoin('tbl_admins as admin', 'publicaciones.lng_idadmin', '=', 'admin.id')
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
    				'pais.str_paises as pais',
    				// Administrador
    				'admin.name as admin'
    				)
    				->get();
    	
    	
        return view('operador.revision',compact('revisiones'))->with('page_title', 'Revision');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function activar($id)
    {
    	$activar = DB::update('update tbl_vehiculos set status_admin = 708 where id = '.$id.'');
    	
    	Session::flash('message', 'La publicación ha sido activada exitosamente');
        return Redirect::route('operador.revision');
 
    }
    
    
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function desactivar($id)
    {
    	$desactivar = DB::update('update tbl_vehiculos set status_admin = 709 where id = '.$id.'');
    	
    	Session::flash('message', 'La publicación no ha sido activada exitosamente');
        return Redirect::route('operador.revision');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function detalle($id)
    {
    	
        // Consulta la tabla Marcas 
        //$data = DB::table('tbl_vehiculos as publicacion')->where('publicacion.id','=',$id)->get();        
        $vehiculo= DB::table('tbl_vehiculos as publicacion')
        ->where('publicacion.id','=',$id)
        ->where('publicacion.bol_eliminado','=',0)
        ->orderBy('publicacion.int_peso')      
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
        // FRENADO
        ->leftjoin('cat_datos_maestros as frenado', 'publicacion.lng_idfrenado', '=', 'frenado.id')     
        // ACEITE
        ->leftjoin('cat_datos_maestros as aceite', 'publicacion.lng_idlibreaceite', '=', 'aceite.id') 
        // ENFRIAMIENTO
        ->leftjoin('cat_datos_maestros as enfriamiento', 'publicacion.lng_idenfriamiento', '=', 'enfriamiento.id')  
        // NEGOCIABLE
        ->join('cat_datos_maestros as negociable', 'publicacion.lng_idnegociable', '=', 'negociable.id')
        // TRACCION
        ->join('cat_datos_maestros as traccion', 'publicacion.lng_idtraccion', '=', 'traccion.id')
        // TAPIZADO
        ->join('cat_datos_maestros as tapizado', 'publicacion.lng_idtapizado', '=', 'tapizado.id')
        // MOTOR REPARADO
        ->join('cat_datos_maestros as motor_reparado', 'publicacion.lng_idmotorreparado', '=', 'motor_reparado.id')
        // VIDRIOS
        ->join('cat_datos_maestros as vidrios', 'publicacion.lng_idvidrios', '=', 'vidrios.id')
        // COLOR
        ->join('cat_datos_maestros as color', 'publicacion.lng_idcolor', '=', 'color.id')
        // COMBUSTIBLE
        ->join('cat_datos_maestros as combustible', 'publicacion.lng_idcombustible', '=', 'combustible.id')
        // Unico Dueño
        ->join('cat_datos_maestros as unico_dueno', 'publicacion.lng_idunicodueno', '=', 'unico_dueno.id')
        // Tipo de Motor
        ->leftjoin('cat_datos_maestros as tipo_motor', 'publicacion.lng_idtipomotor', '=', 'tipo_motor.id')
        // Financiamiento
        ->join('cat_datos_maestros as financiamiento', 'publicacion.lng_idfinanciamiento', '=', 'financiamiento.id')
        // Chocado
        ->join('cat_datos_maestros as chocado', 'publicacion.lng_idchocado', '=', 'chocado.id')
        // Recibo Moto
        ->leftjoin('cat_datos_maestros as recibo_moto', 'publicacion.lng_idrecibomoto', '=', 'recibo_moto.id')
        // Sistema de Arranque
        ->leftjoin('cat_datos_maestros as sistema_arranque', 'publicacion.lng_idsistemaarranque', '=', 'sistema_arranque.id')
        // Maximo de Tripulantes
        ->leftjoin('cat_datos_maestros as max_tripulantes', 'publicacion.lng_idmaxtripulantes', '=', 'max_tripulantes.id')
        // Material
        ->leftjoin('cat_datos_maestros as material', 'publicacion.lng_idmaterial', '=', 'material.id')
        // Ciudad
        ->join('cat_ciudades as ciudad', 'publicacion.lng_idciudad', '=', 'ciudad.id')        
        // Baño
        ->leftjoin('cat_datos_maestros as bano', 'publicacion.lng_idbano', '=', 'bano.id') 
        // Ventana
        ->leftjoin('cat_datos_maestros as ventana', 'publicacion.lng_idventana', '=', 'ventana.id')
        /*            
         
            
         */     
        ///////////////////////////////////////////////////////////////////////////////////////////////////   
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
            'pais_persona.blb_img as pais_imagen_persona',  // Pais Imagen de la Persona
            'servicio.str_descripcion as servicio_persona',  // Servicio en donde se Registro la Persona
            'persona.blb_img as imagen_persona',            // Imagen Persona
            // Tipos - Vehiculo
            'tipo_vehiculo.str_descripcion as v_tipo',  
            // Clasificaciones - Vehiculos
            'clasificacion.str_descripcion as v_clasificacion',
            // Modelos - Vehiculos
            'marca.str_marca as v_marca',
            // Modelos - Vehiculos
            'modelo.str_modelo as v_modelo',            
            // Paises  - Publicaciones
            'pais.blb_img as v_pais_imagen',
            // Pais Imagen - Publicaciones
            'pais.str_paises as v_pais',
            // Pais Moneda - Publicaciones
            'pais.str_moneda as v_moneda_pais',
            // Pais Abreviatura Moneda - Publicaciones
            'pais.str_abreviatura as v_moneda_abreviatura',
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
            'publicacion.int_ancho as v_ancho',
            // Carroceria - Vehiculo
            'publicacion.str_carroceria as v_carroceria',
            // Frenado - Vehiculo
            'frenado.str_descripcion as v_frenado',
            // Frenado - Vehiculo 
            'publicacion.int_carga as v_carga',
            // Levantamiento - Vehiculo 
            'publicacion.int_levantamiento as v_levantamiento',
            // Lastre - Vehiculo 
            'publicacion.int_lastre as v_lastre',
            // Largo - Vehiculo 
            'publicacion.int_largo as v_largo',
            // Aceite - Vehiculo
            'aceite.str_descripcion as v_aceite',
            // Potencia Bruta - Vehiculo 
            'publicacion.int_potenciabruta as v_potencia_bruta',
            // Tambor - Vehiculo 
            'publicacion.str_tambor as v_tambor',
            // Produccion - Vehiculo 
            'publicacion.int_produccion as v_produccion',
            // Enfriamiento - Vehiculo
            'enfriamiento.str_descripcion as v_enfriamiento',
            // Neumatico - Vehiculo 
            'publicacion.dbl_neumatico as v_neumatico',
            // Potencia - Vehiculo 
            'publicacion.int_potencia as v_potencia',
            // Velocidades - Vehiculo 
            'publicacion.int_velocidades as v_velocidades',
            // Pasajeros - Vehiculo 
            'publicacion.int_pasajeros as v_pasajeros',
            // Horas uso - Vehiculo 
            'publicacion.int_horasuso as v_horas_uso',
            // Comentario - Vehiculo 
            'publicacion.str_comentario as v_comentario',
            // Negociable - Vehiculo 
            'negociable.str_descripcion as v_negociable',
            // Traccion - Vehiculo 
            'traccion.str_descripcion as v_traccion',
            // Tapizado - Vehiculo 
            'tapizado.str_descripcion as v_tapizado',
            // Motor Reparado - Vehiculo 
            'motor_reparado.str_descripcion as v_motor_reparado',
            // vidrios - Vehiculo 
            'vidrios.str_descripcion as v_vidrios',
            // Cantidad de Puertas - Vehiculo 
            'publicacion.int_cantidad_puertas as v_cantidad_puertas',
            // Color - Vehiculo 
            'color.str_descripcion as v_color',
            // Combustible - Vehiculo 
            'combustible.str_descripcion as v_combustible',
            // Unico Dueño - Vehiculo 
            'unico_dueno.str_descripcion as v_unico_dueno',
            // Recorrido - Vehiculo  
            'publicacion.str_recorrido as v_str_recorrido',
            // Version - Vehiculo  
            'publicacion.str_version as v_version',
            // Tipo de Motor - Vehiculo 
            'tipo_motor.str_descripcion as v_tipo_motor',
            // Financiamiento - Vehiculo 
            'financiamiento.str_descripcion as v_financiamiento',
            // Chocado - Vehiculo 
            'chocado.str_descripcion as v_chocado',
            // Recibo Moto - Vehiculo 
            'recibo_moto.str_descripcion as v_recibo_moto',
            // Sistema de Arranque - Vehiculo 
            'sistema_arranque.str_descripcion as v_sistema_arranque',
            // Fecha de Publicacion Fin - Vehiculo  
            'publicacion.dmt_fecha_publicacion_fin as v_fecha_publicacion_fin',
            // Fecha de Publicacion Inicio - Vehiculo  
            'publicacion.dmt_fecha_publicacion as v_fecha_publicacion_inicio',
            // bol_eliminado - Vehiculo  
            'publicacion.bol_eliminado as v_bol_eliminado',
            // bol_activa - Vehiculo  
            'publicacion.bol_activa as v_bol_activa',
            // esloralargo - Vehiculo  
            'publicacion.int_esloralargo as v_esloralargo',
            // Manga Ancho - Vehiculo  
            'publicacion.int_mangaancho as v_manga_ancho',
            // Maximo de Tripulantes - Vehiculo 
            'max_tripulantes.str_descripcion as v_max_tripulantes',
            // Material - Vehiculo 
            'material.str_descripcion as v_material',
            // Peso - Vehiculo  
            'publicacion.int_peso as v_peso',
            // Potencia maxima - Vehiculo  
            'publicacion.int_potenciamax as v_potencia_max',
            // Precio de Venta - Vehiculo  
            'publicacion.str_precio_venta as v_precio_venta',
            // Moneda - Vehiculo  
            'publicacion.str_moneda as v_moneda',
            // Ciudad - Vehiculo  
            'ciudad.str_ciudad as v_ciudad',         
            // Video - Vehiculo  
            'publicacion.str_video as v_video',            
            // updated_at - Vehiculo  
            'publicacion.updated_at as v_updated_at',            
            // created_at - Vehiculo              
            'publicacion.created_at as v_created_at',  
            // created_at - Vehiculo  
            'publicacion.status_admin as v_status_admin',
            // status_user - Vehiculo  
            'publicacion.status_user as v_status_user',
            // Baño - Vehiculo  
            'bano.str_descripcion as v_bano',
            // Ventana - Vehiculo  
            'ventana.str_descripcion as v_ventana'            
        	)
        ->get();  
        //return $vehiculo;

        //return $vehiculo[0]->v_video;
        // Extrayendo Valores de Video Youtube y validando parámetros
        /// *********************************************************************************************************
        if ($vehiculo[0]->v_video != NULL) {
                
        $youtube = $vehiculo[0]->v_video;
        // Simple
        //$youtube = "https://www.youtube.com/watch?v=rYEDA3JcQqw"; 
        // Lista 1 una variable
        //$youtube = "https://www.youtube.com/watch?v=rYEDA3JcQqw&list=RDEMTPfPURSbYpb0YHCKyIG37Q";
        // Lista 2 Variables
        //$youtube = "https://www.youtube.com/watch?v=hLQl3WQQoQ0&list=RDEMTPfPURSbYpb0YHCKyIG37Q&index=2";
        // Embebido
        //$youtube = "https://www.youtube.com/embed/LEWcNGcUNAY";
        // Link Otro
        //$youtube = "https://youtu.be/rYEDA3JcQqw?list=RDEMTPfPURSbYpb0YHCKyIG37Q";

        $c1 = "https://www.youtube.com/watch?v=";   // Link Directo
        $c2 = "https://www.youtube.com/embed/";     // Embed
        $c3 = "https://youtu.be/"; // Link otro        
        $caso1 = stristr($youtube, $c1);
        $caso2 = stristr($youtube, $c2);
        $caso3 = stristr($youtube, $c3);         
        
        // Caso 1     
        //echo $caso2;   
        if ($caso1 != NULL) {                        
            // 1.1 Detecta si es un link simple o de lista de reproduccion                     
            $contador = substr_count($youtube, '&');
            //echo $contador;
            if($contador ==0){               
                //echo "Es Caso 1 Simple &raquo; ". $caso1 . "<br>";                              
                $caso1 = str_replace($c1,'',$youtube);                
                $vehiculo[0]->v_video = $caso1;
            }else{
                //echo "Es Caso 1 Lista &raquo; ". $caso1 . "<br>";                              
                $caso1 = str_replace($c1,'',$youtube);
                $caso1 = str_replace('&','?',$caso1);
                $vehiculo[0]->v_video = $caso1;
            }
        // Caso 2   
        }elseif($caso2 != NULL){
            //echo "Es Caso 2 &raquo; ". $caso2 . "<br>";
            $caso2 = str_replace($c2,'',$youtube);                
            $vehiculo[0]->v_video = $caso2;
        }elseif($caso3 != NULL){
            //echo "Es Caso 3 &raquo; ". $caso3 . "<br>";
            $caso3 = str_replace($c3,'',$youtube);                
            $vehiculo[0]->v_video = $caso3;
        }
        } // Fin de ($vehiculo[0]->v_video != NULL) 
        /// *********************************************************************************************************
        
        $a = base64_decode($vehiculo[0]->pais_imagen_persona);

        $b = finfo_open(); 
        $vehiculo[0]->formato_pais_imagen_persona = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);        
        $c = base64_decode($vehiculo[0]->pais_imagen_persona);
        $vehiculo[0]->formato_imagen_persona = finfo_buffer($b, $c, FILEINFO_MIME_TYPE);
        $d = base64_decode($vehiculo[0]->v_pais_imagen);
        $vehiculo[0]->formato_v_pais_imagen = finfo_buffer($b, $d, FILEINFO_MIME_TYPE);
        //return $vehiculo[0]->formato_imagen_persona;        
        //return $vehiculo[0]->imagen_persona; 
        //echo '<img src="data:'. $vehiculo[0]->formato_pais_imagen_persona .';base64,'. $vehiculo[0]->pais_imagen_persona .'">';
        //echo '<img src="data:'. $vehiculo[0]->formato_imagen_persona .';base64,'. $vehiculo[0]->imagen_persona .'">';
        //die();        
        $imagenesVehiculo = DB::table('tbl_imagenes_vehiculos as imagenes')
        ->where('lng_idvehiculo','=',$id)

        // CLASIFICACIONES
        ->select(
        	'imagenes.blb_img as v_imagen',
        	'imagenes.int_peso as v_peso',
        	'imagenes.id as v_id'
        	)
        ->get();
        //return $ImagenesVehiculo;
		//return $imagenesVehiculo[0]->v_imagen;
        //echo '<img src="'. $imagenesVehiculo[0]->v_imagen .'">';
        //die();
        $detalleVehiculo = DB::table('tbl_detalles_vehiculos as detalles')
        ->where('lng_idvehiculo','=',$id)
        // CLASIFICACIONES
        ->join('cat_datos_maestros as caracteristica', 'detalles.lng_idcaracteristica', '=', 'caracteristica.id')
        ->select(
        	// Caracteristica Descripcion - Vehiculo  
        	'caracteristica.str_tipo as v_tipo',
            'caracteristica.str_descripcion as v_descripcion'            
            )
        ->get();
        //return $detalleVehiculo;
        //return $detalleVehiculo[0]->v_tipo;
         
        //return view('vehiculo.publicaciones-inactivas',compact('vehiculo'))->with('page_title', 'Publicaciones Inactivas');    
        //return "Hola";
        $idVehiculo = $id;
        return view('operador.detalle',['idVehiculo'=>$id,'vehiculo'=>$vehiculo,'imagenesVehiculo'=>$imagenesVehiculo,'detalleVehiculo'=>$detalleVehiculo])->with('page_title', 'Detalles');
    }

   public function editarPublicacion(Request $request)
   {
  		$id = $request->id;
    	$idPublicacion = $request->idPublicacion;
    	$imagenes = ImagenesVehiculos::find($id);
    	$imagenes->fill($request->all());
    	$imagenes->save();
    	
    	Session::flash('message','La imágen fue actualizada exitosamente!');
    	return Redirect::to('/operador/detalle/'.$idPublicacion);
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
    public function edit()
    {
    	//
    }  

     /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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

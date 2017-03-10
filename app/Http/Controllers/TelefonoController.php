<?php

namespace Troovami\Http\Controllers;

use Illuminate\Http\Request;

use Troovami\Http\Requests;
use Troovami\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Troovami\Marca;
use Troovami\Modelo;
use Troovami\TipoMarca;
use Troovami\Telefono;
use Troovami\ValoresEspecificaciones;
use Troovami\VersionesValoresEspecificaciones;
use Session;
use Redirect;
use DB;

class TelefonoController extends Controller
{
    public function index()
    {   
       $telefonos= DB::table('tbl_versiones_modelos')        
        ->join('tbl_modelos', 'tbl_versiones_modelos.lng_idmodelo', '=', 'tbl_modelos.id')
        ->join('cat_marcas','tbl_modelos.lng_idmarca','=', 'cat_marcas.id')
        ->select(            
            'tbl_modelos.str_modelo as modelo',
            'cat_marcas.str_marca as marca',
            'tbl_versiones_modelos.str_version as version',
            'tbl_versiones_modelos.bol_eliminado',
            'tbl_versiones_modelos.id'                                  
                )         
        ->get();
        return view('telefono.index',compact('telefonos'))->with('page_title', 'Principal');
    }

    public function mobile()
    { 
        $clasificacion=  713;
        $telefonos= DB::table('tbl_versiones_modelos')  
        ->join('tbl_modelos', 'tbl_versiones_modelos.lng_idmodelo', '=', 'tbl_modelos.id')
        ->join('cat_marcas','tbl_modelos.lng_idmarca','=', 'cat_marcas.id')
        ->where('tbl_modelos.lng_idclasificacion','=',$clasificacion) 
        ->select(            
            'tbl_modelos.str_modelo as modelo',
            'cat_marcas.str_marca as marca',
            'tbl_versiones_modelos.str_version as version',
            'tbl_versiones_modelos.bol_eliminado',
            'tbl_versiones_modelos.id'                                  
                )         
        ->get();
        return view('telefono.mobile',compact('telefonos'))->with('page_title', 'Principal');
    }

    public function smartwatch()
    { 
        $clasificacion= 715; 
        $smartwatch= DB::table('tbl_versiones_modelos')  
        ->join('tbl_modelos', 'tbl_versiones_modelos.lng_idmodelo', '=', 'tbl_modelos.id')
        ->join('cat_marcas','tbl_modelos.lng_idmarca','=', 'cat_marcas.id')
        ->where('tbl_modelos.lng_idclasificacion','=',$clasificacion) 
        ->select(            
            'tbl_modelos.str_modelo as modelo',
            'cat_marcas.str_marca as marca',
            'tbl_versiones_modelos.str_version as version',
            'tbl_versiones_modelos.bol_eliminado',
            'tbl_versiones_modelos.id'                                  
                )         
        ->get();
        return view('telefono.smartwatch',compact('smartwatch'))->with('page_title', 'Principal');
    }

    public function tablet()
    { 
        $clasificacion=  714;
        $tablet= DB::table('tbl_versiones_modelos')      
        ->join('tbl_modelos', 'tbl_versiones_modelos.lng_idmodelo', '=', 'tbl_modelos.id')
        ->join('cat_marcas','tbl_modelos.lng_idmarca','=', 'cat_marcas.id')
        ->where('tbl_modelos.lng_idclasificacion','=',$clasificacion) 
        ->select(            
            'tbl_modelos.str_modelo as modelo',
            'cat_marcas.str_marca as marca',
            'tbl_versiones_modelos.str_version as version',
            'tbl_versiones_modelos.bol_eliminado',
            'tbl_versiones_modelos.id'                                  
                )         
        ->get();
        return view('telefono.tablet',compact('tablet'))->with('page_title', 'Principal');
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

        $modelos = DB::table('tbl_modelos')
        ->where('tbl_modelos.lng_idtipo_equipo','=',154)
        ->where('tbl_modelos.lng_idmarca','=',212)
        ->select(
            'tbl_modelos.str_modelo as nombre_modelo',
            'tbl_modelos.id as id_modelo'
            )
        ->distinct()
        ->lists('nombre_modelo','id_modelo');

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

        $simcard= DB::table('cat_datos_maestros')
        ->where('cat_datos_maestros.str_tipo', '=' , 'SIM CARDS')
        ->select(
            'cat_datos_maestros.str_descripcion as simcard',
            'cat_datos_maestros.id as id_simcard'
        )
        ->distinct()
        ->get();

        $tipo_pantalla= DB::table('cat_datos_maestros')
        ->where('cat_datos_maestros.str_tipo', '=' , 'pantalla')
        ->select(
            'cat_datos_maestros.str_descripcion as tipo_pantalla',
            'cat_datos_maestros.id as id_tipo_pantalla'
        )
        ->distinct()
       ->get();

        $color= DB::table('cat_datos_maestros')
        ->select(
            'cat_datos_maestros.str_descripcion as nombre_color',
            'cat_datos_maestros.str_caracteristica as id_color'
        )
        ->where('cat_datos_maestros.str_tipo', '=' , 'color')
        ->get();

        $so= DB::table('cat_datos_maestros')
        ->select(
            'cat_datos_maestros.str_descripcion as so_nombre',
            'cat_datos_maestros.id as id_so'
        )
        ->where('cat_datos_maestros.str_tipo', '=' , 'SO')
        ->get();

        $um= DB::table('cat_datos_maestros')
        ->where('cat_datos_maestros.str_tipo', '=' , 'UM')
        ->select(
            'cat_datos_maestros.str_descripcion as um_nombre',
            'cat_datos_maestros.id as id_um'
        )
        ->get();

        $resolucion= DB::table('cat_datos_maestros')
        ->where('cat_datos_maestros.str_tipo', '=' , 'video')
        ->select(
            'cat_datos_maestros.str_descripcion as resolucion',
            'cat_datos_maestros.id as id_resolucion'
        )
        ->get();

        $frecuencias= DB::table('cat_frecuencias')
        ->select(
                'cat_frecuencias.str_frecuecia as frecuencia',
                'cat_frecuencias.id as id_frecuencia'
                )
        ->get();

        $sensor= DB::table('cat_datos_maestros')
        ->where('cat_datos_maestros.str_tipo', '=' , 'sensor')
        ->select(
            'cat_datos_maestros.str_descripcion as sensor',
            'cat_datos_maestros.id as id_sensor'
        )
        ->get();

         $mensajeria= DB::table('cat_datos_maestros')
        ->where('cat_datos_maestros.str_tipo', '=' , 'mensajeria')
        ->select(
            'cat_datos_maestros.str_descripcion as mensajeria',
            'cat_datos_maestros.id as id_mensajeria'
        )
        ->get();

       return view('telefono.create',['marcas'=>$marcas,'modelos'=>$modelos,'gama'=>$gama,'clasificacion'=>$clasificacion,'simcard'=>$simcard,'tipo_pantalla'=>$tipo_pantalla,'color'=>$color,'so'=>$so,'um'=>$um,'resolucion'=>$resolucion,'frecuencias'=>$frecuencias,'sensor'=>$sensor,'mensajeria'=>$mensajeria])->with('page_title', 'Agregar');
    }

    public function store(Request $request)
    {
        $id_admin = Auth::id();
        /*$this->validate($request, [
        'str_version'         => 'required|unique:tbl_versiones_modelos',            
        ]);   */

       

        $interno_full=$request->input('str_descripcion')[20]." ".$request->input('str_descripcion')[21];
        $ram_full=$request->input('str_descripcion')[22]." ".$request->input('str_descripcion')[23];
        

        $telefono = Telefono::create([
        'str_version'           => ucfirst(strtolower($request->input('str_version'))),
        'lng_idmodelo'          => $request->input('lng_idmodelo'),
        'lng_idadmin'           => $id_admin,
        'int_cantidad'          => 1,
        'bol_eliminado'         => 0,
        ]);

        $id_version = $telefono->id;

        for($i=0;$i<count($request->input('str_titulo'));$i++)
        {   
           $especificacion = ValoresEspecificaciones::create([
                'lng_idespecificacion'  => $request->input('lng_idespecificacion')[$i],
                'str_titulo'            => $request->input('str_titulo')[$i],
                'str_descripcion'       => $request->input('str_descripcion')[$i],
                'int_comparacion'       => 1,
                'int_valor'             => 1,
                'bol_eliminado'         => 0,
                ]);
            

            $id_especificacion =$especificacion->id;

            VersionesValoresEspecificaciones::create([
                'lng_idversion_modelo'              => $id_version,
                'lng_idvalores_especificaciones'    => $id_especificacion,
                'bol_eliminado'                     => 0,
            ]);

        }

        

        $colores = count($request->input('str_color'));
            
        for ($j=0; $j < $colores; $j++) 
        { 
            $especificacion2 = ValoresEspecificaciones::create([
            'lng_idespecificacion'  => 3,
            'str_titulo'            => "Color",
            'str_descripcion'       => $request->input('str_color')[$j],
            'int_comparacion'       => 1,
            'int_valor'             => 1,
            'bol_eliminado'         => 0,
            ]);  

            $id_especificacion2 =$especificacion2->id;

            VersionesValoresEspecificaciones::create([
                'lng_idversion_modelo'              => $id_version,
                'lng_idvalores_especificaciones'    => $id_especificacion2,
                'bol_eliminado'                     => 0,
            ]);
        }

         $sensor = count($request->input('str_sensores'));
            
        for ($k=0; $k < $sensor; $k++) 
        { 
            $especificacion3 = ValoresEspecificaciones::create([
            'lng_idespecificacion'  => 10,
            'str_titulo'            => "Sensores",
            'str_descripcion'       => $request->input('str_sensores')[$k],
            'int_comparacion'       => 1,
            'int_valor'             => 1,
            'bol_eliminado'         => 0,
            ]);  

            $id_especificacion3 =$especificacion3->id;

            VersionesValoresEspecificaciones::create([
                'lng_idversion_modelo'              => $id_version,
                'lng_idvalores_especificaciones'    => $id_especificacion3,
                'bol_eliminado'                     => 0,
            ]);
        } 

         $mensajeria = count($request->input('str_mensajeria'));
            
        for ($l=0; $l < $mensajeria; $l++) 
        { 
            $especificacion4 = ValoresEspecificaciones::create([
            'lng_idespecificacion'  => 10,
            'str_titulo'            => "Mensajeria",
            'str_descripcion'       => $request->input('str_mensajeria')[$l],
            'int_comparacion'       => 1,
            'int_valor'             => 1,
            'bol_eliminado'         => 0,
            ]);  

            $id_especificacion4 =$especificacion4->id;

            VersionesValoresEspecificaciones::create([
                'lng_idversion_modelo'              => $id_version,
                'lng_idvalores_especificaciones'    => $id_especificacion4,
                'bol_eliminado'                     => 0,
            ]);
        }


        Session::flash('message', 'El Telefono en la versión &laquo;'. $request['str_version'] .'&raquo;, ha sido Registrado Exitosamente');        
        return Redirect::route('telefono.create');
    }

    public function dep_modelo(Request $request)
    {
        $busqueda=$request->input('elegido');
        $buscar=Modelo::where('lng_idmarca','=',$busqueda)->get();
        return response()->json($buscar);
       // return response()->json($buscar);
    }

   
    public function edit($id)
    {
       $telefono= DB::table('tbl_versiones_modelos')      
        ->join('tbl_modelos', 'tbl_versiones_modelos.lng_idmodelo', '=', 'tbl_modelos.id')
        ->join('cat_marcas','tbl_modelos.lng_idmarca','=', 'cat_marcas.id')
        ->where('tbl_versiones_modelos.id','=',$id)
        ->select( 
            'tbl_versiones_modelos.str_version as version',
            'cat_marcas.str_marca as marca',
            'tbl_modelos.str_modelo as modelo',
            'tbl_versiones_modelos.bol_eliminado',
            'tbl_versiones_modelos.id'                                  
                )         
        ->get();


        return view('telefono.edit',['telefono'=>$telefono])->with('page_title', 'Editar');        
    }  
    
    public function update()
    {   
        
    }
    
    public function show($id)
    {   
        $telefono= DB::table('tbl_versiones_modelos')      
        ->join('tbl_modelos', 'tbl_versiones_modelos.lng_idmodelo', '=', 'tbl_modelos.id')
        ->join('cat_marcas','tbl_modelos.lng_idmarca','=', 'cat_marcas.id')
        ->where('tbl_versiones_modelos.id','=',$id)
        ->select( 
            'tbl_versiones_modelos.str_version as version',
            'cat_marcas.str_marca as marca',
            'tbl_modelos.str_modelo as modelo',
            'tbl_versiones_modelos.bol_eliminado',
            'tbl_versiones_modelos.id'                                  
                )         
        ->get();

        $version= $telefono[0]->id;
       
        $especificacion = DB::table('tbl_versiones_valores_especificaciones')
        ->join('cat_valores_especificaciones', 'tbl_versiones_valores_especificaciones.lng_idvalores_especificaciones', '=' ,'cat_valores_especificaciones.id')
        ->join('cat_especificaciones', 'cat_valores_especificaciones.lng_idespecificacion', '=' ,'cat_especificaciones.id')
        ->join('tbl_versiones_modelos', 'tbl_versiones_valores_especificaciones.lng_idversion_modelo', '=' ,'tbl_versiones_modelos.id')
        ->where('tbl_versiones_valores_especificaciones.lng_idversion_modelo', '=', $version)
        ->select(
                'cat_valores_especificaciones.lng_idespecificacion as posicion',
                'cat_especificaciones.str_especificacion as titulo',
                'cat_valores_especificaciones.str_titulo as subtitulo',
                'cat_valores_especificaciones.str_descripcion as valor'
                
                )
        ->orderBy('cat_valores_especificaciones.lng_idespecificacion')
        ->get();

        return view('telefono.show',['telefono'=>$telefono,'especificacion'=>$especificacion])->with('page_title', 'Show'); 
    }
    
    public function status()
    {   
        
    }

    public function delete($id)
    {
        $vve = DB::table('tbl_versiones_valores_especificaciones')
        ->where('tbl_versiones_valores_especificaciones.lng_idversion_modelo', '=', $id)
        ->select(
                'tbl_versiones_valores_especificaciones.*'
                )
        ->get();


        for ($i=0; $i < count($vve); $i++) 
        { 
            $valoresEspecificaciones = $vve[$i]->lng_idvalores_especificaciones; 
            $delete = DB::table('cat_valores_especificaciones')
            ->where('id', '=', $valoresEspecificaciones)
            ->delete();

        }

        for ($j=0; $j < count($vve) ; $j++) 
        { 
            $versionValoresEspecificaciones = $vve[$j]->id;
            $delete2 = DB::table('tbl_versiones_valores_especificaciones')
            ->where('id', '=', $versionValoresEspecificaciones)
            ->delete();
        }
        
        $delete3 = DB::table('tbl_versiones_modelos')
        ->where('id', '=', $id)
        ->delete();
        
        Session::flash('message', 'Telefono Eliminado Exitosamente');           
        return Redirect::route('telefono.index');                    
    }

    
    public function destroy($id)
    {
        
    }

}


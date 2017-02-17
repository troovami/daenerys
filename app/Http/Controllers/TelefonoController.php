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
use Session;
use Redirect;
use DB;

class TelefonoController extends Controller
{
    public function index()
    {   
        return view('telefono.index')->with('page_title', 'Principal');
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

       /*dd($sensor);
        exit();*/
       
       return view('telefono.create',['marcas'=>$marcas,'modelos'=>$modelos,'gama'=>$gama,'clasificacion'=>$clasificacion,'simcard'=>$simcard,'tipo_pantalla'=>$tipo_pantalla,'color'=>$color,'so'=>$so,'um'=>$um,'resolucion'=>$resolucion,'frecuencias'=>$frecuencias,'sensor'=>$sensor])->with('page_title', 'Agregar');
    }

    public function store(Request $request)
    {
        $id_admin = Auth::id();
        /*$this->validate($request, [
        'str_version'         => 'required|unique:tbl_versiones_modelos',            
        ]);   */

        Telefono::create([
        'str_version'           => ucfirst(strtolower($request->input('str_version'))),
        'lng_idmodelo'          => $request->input('lng_idmodelo'),
        'lng_idadmin'           => $id_admin,
        'int_cantidad'          => 1,
        'bol_eliminado'         => 0,
        ]);

        $j=1;
        
        for($i=0;$i<count($request->input('str_titulo'));$i++)
        {   
            $colores = count($request->input('str_color'));
            dd($colores);
            exit();
            /*if($j==3)
            {
                $colores = count($request->input('str_titulo_color'));
                dd($colores);
                exit();
                for ($i=0; $i < $colores; $i++) 
                { 
                  ValoresEspecificaciones::create([
                'lng_idespecificacion'  => $j,
                'str_titulo'            => $request->input('str_titulo_color')[$i],
                'str_descripcion'       => $request->input('str_color')[$i],
                'int_comparacion'       => 1,
                'int_valor'             => 1,
                'bol_eliminado'         => 0,
                ]);  
                }
            }*/
            

        ValoresEspecificaciones::create([
        'lng_idespecificacion'  => $j,
        'str_titulo'            => $request->input('str_titulo')[$i],
        'str_descripcion'       => $request->input('str_descripcion')[$i],
        'int_comparacion'       => 1,
        'int_valor'             => 1,
        'bol_eliminado'         => 0,
        ]);
        if($i==2 or $i==4 or $i==11 or $i==16 or $i==19 or$i==24 or $i==29 or $i==32 or $i==39 or $i==44 or $i==48)
        {
            $j++;
        }

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

    public function mobile()
    {   
        return view('telefono.mobile')->with('page_title', 'Principal');
    }

    public function smartwatch()
    {   
        return view('telefono.smartwatch')->with('page_title', 'Principal');  
    }
    
    public function tablet()
    {   
        return view('telefono.tablet')->with('page_title', 'Principal');  
    }
   
    public function edit()
    {   
        
    }
    
    public function update()
    {   
        
    }
    
    public function show()
    {   
        
    }
    
    public function status()
    {   
        
    }

    public function delete()
    {   
        
    }

    public function destroy()
    {   
        
    }

}


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
use Troovami\ImagenesTelefonos;
use Troovami\FrecuenciasTecnosVersiones;
use Intervention\Image\ImageManager;
use Session;
use Redirect;
use DB;
use Storage;


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

        $telefono = Telefono::create([
        'str_version'           => ucfirst(strtolower($request->input('str_version'))),
        'lng_idmodelo'          => $request->input('lng_idmodelo'),
        'lng_idadmin'           => $id_admin,
        'int_cantidad'          => 1,
        'bol_eliminado'         => 0,
        ]);

        $id_version = $telefono->id;

        

        
                
        for ($j = 0; $j < count($request->file('blb_img')); $j++)
        {   
            $path = "/home/angelo/Imágenes/daenerys/telefonos/";

            //obtenemos el campo file definido en el formulario
            $file[] = $request->file('blb_img')[$j];

            //obtenemos el nombre del archivo
            $nombre[] = $file[$j]->getClientOriginalName();
            $extension[] = $file[$j]->getClientOriginalExtension();
            

            //indicamos que queremos guardar un nuevo archivo en el disco local

            $image[] = \Input::file('blb_img')[$j];
            $filename[]  = $id_version.'_'.$j.'.'.$extension[$j];
            $ruta[] = $path . $filename[$j];

            
            \Image::make($image[$j]->getRealPath())->resize(1000, 1500)->save($ruta[$j]);


            $imagenes = ImagenesTelefonos::create([
                'lng_idversion'     =>  $id_version,
                'blb_img'           =>  $ruta[$j],                  
                'str_alt'           =>  "",
                'bol_eliminado'     =>  0,
            ]);

       }

        for($i=0;$i<count($request->input('str_titulo'));$i++)
        {   
           

            if($request->input('str_titulo')[$i]=='Color' or $request->input('str_titulo')[$i]=='Sensores' or $request->input('str_titulo')[$i]=='Mensajeria'){
                if($request->input('str_titulo')[$i]=='Color'){
                     $contador = count($request->input('str_color'));
                     $especifi=3;
                     $posicion=$request->input('str_color');

                }if($request->input('str_titulo')[$i]=='Sensores'){

                    $contador = count($request->input('str_sensores'));
                    $especifi=10;
                    $posicion=$request->input('str_sensores');

                }if($request->input('str_titulo')[$i]=='Mensajeria'){

                    $contador = count($request->input('str_mensajeria'));
                    $especifi=10;
                    $posicion=$request->input('str_mensajeria');
                }
               
                    for ($j=0; $j < $contador; $j++) 
                    { 
                        $especificacion2 = ValoresEspecificaciones::create([
                        'lng_idespecificacion'  => $especifi,
                        'str_titulo'            => $request->input('str_titulo')[$i],
                        'str_descripcion'       => $posicion[$j],
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

            }

            else
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

    public function operadora()
    {
        $telefonos= DB::table('tbl_versiones_modelos')        
        ->join('tbl_modelos', 'tbl_versiones_modelos.lng_idmodelo', '=', 'tbl_modelos.id')
        ->join('cat_marcas','tbl_modelos.lng_idmarca','=', 'cat_marcas.id')
        ->leftJoin('tbl_frecuencias_tecnos_versiones','tbl_versiones_modelos.id', '=', 'tbl_frecuencias_tecnos_versiones.lng_idversion_modelo')
        ->leftJoin('tbl_frecuencias_tecnos_operadoras','tbl_frecuencias_tecnos_versiones.lng_frec_tecno_oper', '=', 'tbl_frecuencias_tecnos_operadoras.id')
        ->leftJoin('tbl_operadora_pais','tbl_frecuencias_tecnos_operadoras.lng_idoperadora_pais', '=', 'tbl_operadora_pais.id')
        ->leftJoin('tbl_operadoras','tbl_operadora_pais.lng_idoperadora', '=', 'tbl_operadoras.id')
        ->leftJoin('cat_paises','tbl_operadora_pais.lng_idpais', '=', 'cat_paises.id')
        ->leftJoin('cat_tecnologias_frecuencias', 'tbl_frecuencias_tecnos_operadoras.lng_idfrecuencia_tecnologia', '=', 'cat_tecnologias_frecuencias.id')
        ->leftJoin('cat_frecuencias', 'cat_tecnologias_frecuencias.lng_idfrecuencia', '=', 'cat_frecuencias.id')
        ->leftJoin('cat_tecnologias', 'cat_tecnologias_frecuencias.lng_idtecnologia', '=', 'cat_tecnologias.id')
        ->select(            
            'tbl_modelos.str_modelo as modelo',
            'cat_marcas.str_marca as marca',
            'tbl_versiones_modelos.str_version as version',
            'tbl_versiones_modelos.bol_eliminado',
            'tbl_versiones_modelos.id as id',
            'tbl_operadoras.str_operadora as operadora'                                  
                )       
        ->groupby('id')
        ->distinct('id')
        ->get();

        return view('telefono.operadora',compact('telefonos'))->with('page_title', 'Principal'); 
    }

    public function add_operadora($id)
    {
        $telefono = Telefono::findOrFail($id);
        
        $operadoras = DB::table('tbl_frecuencias_tecnos_operadoras')
        ->join('cat_tecnologias_frecuencias', 'tbl_frecuencias_tecnos_operadoras.lng_idfrecuencia_tecnologia', '=', 'cat_tecnologias_frecuencias.id')
        ->join('cat_frecuencias', 'cat_tecnologias_frecuencias.lng_idfrecuencia', '=', 'cat_frecuencias.id')
        ->join('cat_tecnologias', 'cat_tecnologias_frecuencias.lng_idtecnologia', '=', 'cat_tecnologias.id')
        ->join('tbl_operadora_pais', 'tbl_frecuencias_tecnos_operadoras.lng_idoperadora_pais', '=', 'tbl_operadora_pais.id')
        ->join('cat_paises','tbl_operadora_pais.lng_idpais','=','cat_paises.id')
        ->join('tbl_operadoras','tbl_operadora_pais.lng_idoperadora','=','tbl_operadoras.id')
        ->select(
            'tbl_frecuencias_tecnos_operadoras.id as id',
            'cat_paises.str_paises as pais',
            'tbl_operadoras.str_operadora as operadora',
            'cat_frecuencias.str_frecuecia as frecuencia',
            DB::raw('CONCAT(tbl_operadoras.str_operadora, " ", cat_paises.str_paises, " ", cat_tecnologias.str_especificaciones, " ", cat_tecnologias.str_description, " en la frecuencia ", cat_frecuencias.str_frecuecia) AS tecnologia_full'),

            'tbl_frecuencias_tecnos_operadoras.bol_eliminado'
            )
        ->get();

        /*dd($operadoras);
        exit();*/

       return view('telefono.create_operadora',compact('telefono','operadoras'))->with('page_title', 'Principal'); 
    }

    public function store_operadora(Request $request)
    {   

        $operadora = FrecuenciasTecnosVersiones::create([
        'lng_idversion_modelo'       => $request->input('lng_idversion_modelo'),
        'lng_frec_tecno_oper'        => $request->input('lng_frec_tecno_oper'),
        'bol_eliminado'              => 0,
        ]);

        $id = $operadora->lng_idversion_modelo;

        Session::flash('message', 'Se le ha asociado una Operadora a la &laquo;'. $request['str_version'] .'&raquo; Exitosamente');        
        return Redirect::route('telefono.create_operadora',$id);
    }

}


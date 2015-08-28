<?php

namespace Troovami\Http\Controllers;

use Illuminate\Http\Request;

use Troovami\Http\Requests;
use Troovami\Http\Controllers\Controller;
use Troovami\Marca;
use Troovami\TipoMarca;
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
        $marcas = DB::table('cat_marcas')->select('id', 'str_marca','bol_eliminado','blb_img')->orderBy('str_marca')->skip(0)->take(50)->get();
        foreach ($marcas as $key => $value) {                    
            // Detectando el Tipo de Formato del la Imagen              
            $a = base64_decode($value->blb_img);
            $b = finfo_open();            
            //Agregando un nuevo atributo al array
            $value->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);   
            //return $value->format;         
        }
        //return $marcas;
        //$allMarcas = Marca::All();        
        // Inicio Paginador
        $count = DB::table('cat_marcas')->count(); // Cantidad de Marcas ej: 1000 marcas        
        $paginado = [
            'incremento'  => 0,      // inicializado en 0 para el while
            'numeracion'  => 0,      // Numeros de paginas, inicializado en 0 Ej: pag 1 . pagi 2 . pag n...
            'filtro'      => 50,     // cantidad por pagina take('filtro') laravel
            'total'       => $count, // Total de datos en tabla            
            'recorrido'   => 0       // skip('recorrido') laravel
            ];
        $filtro = [];         
        while ($paginado['incremento'] < $paginado['total']) {

            $paginado['incremento'] = $paginado['incremento'] + $paginado['filtro']; // Ej: incremento = 0 + 50 => 50            
                
            if($paginado['incremento'] >= $paginado['total']){                
                $paginado['recorrido']  = $paginado['incremento'] - $paginado['filtro'];                
                $paginado['numeracion']++;
                $filtro[] = 
                    [ 
                        'numeracion' => $paginado['numeracion'],
                        'skip'       => $paginado['recorrido'],
                        'take'       => $paginado['filtro']
                    ];                                      
                    //echo '<'. $paginado['numeracion'] .'>' . 'desde ' . $paginado['recorrido'] . ' hasta ' . $paginado['total'] . '<br>';

            }else {
                $paginado['recorrido']  = $paginado['incremento'] - $paginado['filtro'];
                $paginado['numeracion']++;
                $filtro[] = 
                    [ 
                        'numeracion' => $paginado['numeracion'],
                        'skip'       => $paginado['recorrido'],
                        'take'       => $paginado['filtro']
                    ];   
                    //echo '<'. $paginado['numeracion'] .'>' . 'desde ' . $paginado['recorrido'] . ' hasta ' . $paginado['incremento'] . '<br>';
            }
        }        
        // Fin Paginador       
        return view('marca.marca',['marcas'=>$marcas,'filtro'=>$filtro, 'total'=>$count])->with('page_title', 'Principal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tipo = DB::table('cat_datos_maestros')->where('str_tipo','tipos')->orderBy('str_tipo')->lists('str_descripcion','id');
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
            'lng_idtipo'           => 'required|array|min:1',
            'blb_img'              => 'required|image|mimes:jpeg,png',
            'str_friendly_url'     => 'required|unique:cat_marcas|regex:/^[a-z\d_]{2,50}$/i',       
            'str_website'          => 'required|unique:cat_marcas|regex:/^[a-z\d_]{2,50}$/i',
        ]);

        // Creando la Marca
        $marca = Marca::create([
            'str_marca'            => ucfirst(strtolower($request['str_marca'])),            
            'blb_img'              => base64_encode(file_get_contents($request['blb_img'])),
            'str_friendly_url'     => $request['str_friendly_url'],            
            'str_website'          => $request['str_website'],

        ]);
        // Id de la Marca
        $lastInsertedId = $marca->id; 
        // Creando Tipos Asociado a la Marca
        $tipos = $request->lng_idtipo;
        $contador = count($tipos);
        for ($i=0; $i < $contador; $i++) {             
            $tipo = $tipos[$i];                       
            TipoMarca::create([
                'lng_idmarca'           => $lastInsertedId,
                'lng_idtipo'            => $tipo,               

            ]);    
        } 
        Session::flash('message', 'La marca &laquo;'. $request['str_marca'] .'&raquo;, ha sido Registrada Exitosamente');        
        return Redirect::route('marca.create');
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
        $marca = Marca::findOrFail($id);

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {     
        // Consulta la tabla Marcas 
        $marca = Marca::findOrFail($id);

        $a = base64_decode($marca->blb_img);
        $b = finfo_open(); 
        $marca->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);
        // Consulta los Tipos Asociados a la Marca       
        $tipos_marca= DB::table('tbl_tipos_marcas')        
        ->where('lng_idmarca',$id)
        ->join('cat_datos_maestros', 'tbl_tipos_marcas.lng_idtipo', '=', 'cat_datos_maestros.id')
        ->select(            
            'cat_datos_maestros.id'                        
                )         
        ->get();        
        //$hola = [['Hola'  => '1000', 'Hola2' => 'Lorem Ipsum'],['Hola'  => '1000','Hola2' => 'Lorem Ipsum'],];   
        // Consulta todos los Tipos
        $tipos = DB::table('cat_datos_maestros')->where('str_tipo','tipos')->orderBy('str_tipo')->select('id','str_descripcion')->get();
        // Asigna un nuevo atributo a los tipos asociados a la Marca
        for ($i=0; $i < count($tipos); $i++) { 
            $tipos[$i]->attrib = '';
        }
        // Todos los Tipos
        for ($i=0; $i < count($tipos); $i++) { 
            // Tipos Asociados a la Marca
            for ($q=0; $q < count($tipos_marca); $q++) { 
                if ($tipos_marca[$q]->id == $tipos[$i]->id) {
                    // Atributo
                    $tipos[$i]->attrib = 'selected="selected"';
                }
            } // for            
        } // for      
        return view('marca.edit',['marca'=>$marca,'tipos'=>$tipos])->with('page_title', 'Editar');
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
            'str_marca'            => 'required|unique:cat_marcas,str_marca,'. $id,
            'lng_idtipo'           => 'required|array|min:1',
            'blb_img'              => 'image|mimes:jpeg,png',
            'str_friendly_url'     => 'required|regex:/^[a-z\d_]{2,50}$/i|unique:cat_marcas,str_friendly_url,'. $id,                        
            'str_website'          => 'required|regex:/^[a-z\d_]{2,50}$/i|unique:cat_marcas,str_website,'. $id,
        ]);  
        //return $request['str_marca'];  
        ///////////////////////////////////////////////////////////////////////////////////////////////////////
        // Actualiza los Datos de una Marca
        $marca = Marca::find($id);        
        if($request['blb_img']==""){            
            $marca->fill($request->all());                
        }else {

            $marca->fill([
            'str_marca'            => ucfirst(strtolower($request['str_marca'])),  
            'blb_img'              => base64_encode(file_get_contents($request['blb_img'])),          
            'lng_idtipo'           => $request['lng_idtipo'],
            'str_friendly_url'     => $request['str_friendly_url'],            
            'str_website'          => $request['str_website'],
            ]);
            
        }                 
        $marca->save(); 
        //Session::flash('message', 'La marca &laquo;'. $request['str_marca'] .'&raquo;, ha sido Actualizada Exitosamente');        
        //return Redirect::route('marca.edit',$id);
        ///////////////////////////////////////////////////////////////////////////////////////////////////////
        // Tipo(s) Asociado(s) a la Marca  

        // Tipos Asociados Almacenados actualmente en BD
        $tiposAsociadosMarca = DB::table('tbl_tipos_marcas')->where('lng_idmarca', "=", $id)->get();
        // Cantidad de Tipos Asociados Almacenados actualmente en BD
        $counTiposAsociados = count($tiposAsociadosMarca);
        // Nuevos Tipos Asociados
        //$nuevosTiposAsociados = $request->lng_idtipo;
        $nuevosTiposAsociados = $request['lng_idtipo'];
        // Cantidad de Nuevos Tipos Asociados
        $countNuevosTiposAsociados = count($nuevosTiposAsociados);
        
        //return $tiposAsociadosMarca;
        //return $tiposAsociadosMarca[0]->id; 
        //return $counTiposAsociados;
        //return $nuevosTiposAsociados;
        //return $nuevosTiposAsociados[0];
        //return $countNuevosTiposAsociados;
        
        //return $id;
        // Delete tipos asociados a la marca            
        //$delete = DB::table('tbl_tipos_marcas')->where('id','=',882)->delete();
        $delete = DB::table('tbl_tipos_marcas')->delete(882);
        return $delete;
        // Guarda los nuevos tipos asociados a la marca y mantiene los datos SEO de algunos tipos ya registrados
            
            for ($i=0; $i < $countNuevosTiposAsociados; $i++) {  
                $NewTipoAsoc = $nuevosTiposAsociados[$i]; // Guarda solo 1 (un) nuevo tipo asociado
                //echo "<b>" . $NewTipoAsoc . "</b><br>";
                $str_meta_descripcion = ""; // SEO Descripcion
                $str_meta_keyword = ""; // SEO Keyword
                //// **********************
                // Asigna los valores de los meta ha aquellos con (ids Anteriores) lng_idtipo == id (ids Nuevos)
                for($k=0; $k < $counTiposAsociados; $k++) { 
                    $ActualTipoAsociado = $tiposAsociadosMarca[$k]->lng_idtipo; // Guarda 1 (un) Actual tipo asociado
                    //echo $ActualTipoAsociado[0];
                    //echo $tiposAsociadosMarca[$k]->lng_idtipo . "<br>"; 
                    //echo $ActualTipoAsociado . "<br>";
                    if($NewTipoAsoc == $ActualTipoAsociado){                        
                        $str_meta_descripcion = $tiposAsociadosMarca[$k]->str_meta_descripcion;                      
                        $str_meta_keyword = $tiposAsociadosMarca[$k]->str_meta_keyword;
                    }   
                     
                }
                //echo "metaD: " . $str_meta_descripcion . "<br>";                
                //echo "metaK: " . $str_meta_keyword . "<br>";
                //echo "<br>";
            
                
            TipoMarca::create([
                'lng_idmarca'           => $id,
                'lng_idtipo'            => $NewTipoAsoc,               
                'str_meta_descripcion'  => $str_meta_descripcion,
                'str_meta_keyword'      => $str_meta_keyword,
                ]);  
               
            } // end for
            //return "stop";
            
        ///////////////////////////////////////////////////////////////////////////////////////////////////////      

        //$tipo = DB::table('tbl_tipos_marcas')->where('lng_idmarca',$id)->orderBy('id')->select('id','str_meta_descripcion','str_meta_keyword','lng_idtipo')->get();        

        //$contador = count($tipo);

        ///////////////////////// **************************
        // toma la información de los meta (descripcion y keywords previamente almacenados en los tipos asociados)
        // Objetivo: Comparar con los nuevos Tipos asociados a la marca y asignarle los valores meta a los id de tipos iguales.
        //$seo = $tipo;
        //$seo_count = count($seo);
        ///////////////////////// **************************
/*
        if($contador==0){
                       
            // array con los tipos "id" asociados a la marca           
            $tipos = $request->lng_idtipo;
            // Cuenta la cantidad de tipos
            $contador = count($tipos);
            // Guarda los nuevos tipos asociados a la marca
            for ($i=0; $i < $contador; $i++) {             
            $tipo = $tipos[$i];                       
            TipoMarca::create([
                'lng_idmarca'           => $id,
                'lng_idtipo'            => $tipo,               
                ]);  
            } // end for  
        } else{   

            // Delete tipos asociados a la marca            
            DB::table('tbl_tipos_marcas')->where('lng_idmarca', '=', $id)->delete();
            // array con los tipos "id" asociados a la marca           
            $tipos = $request->lng_idtipo;
            // Cuenta la cantidad de tipos
            $contador = count($tipos);

            // Guarda los nuevos tipos asociados a la marca
            for ($i=0; $i < $contador; $i++) {             
            $tipo = $tipos[$i];
            $str_meta_descripcion = "";
            $str_meta_keyword = "";
                //// **********************
                // Asigna los valores de los meta ha aquellos con (ids Anteriores) lng_idtipo == id (ids Nuevos)
                for($k=0; $k < $seo_count; $k++) {                    
                    $seo_id = $seo[$k]->lng_idtipo;
                    if($tipo == $seo_id){                        
                        $str_meta_descripcion = $seo[$k]->str_meta_descripcion;                         
                        $str_meta_keyword = $seo[$k]->str_meta_keyword;
                    }                     
                } 
                //// **********************     

            TipoMarca::create([
                'lng_idmarca'           => $id,
                'lng_idtipo'            => $tipo,               
                'str_meta_descripcion'  => $str_meta_descripcion,
                'str_meta_keyword'      => $str_meta_keyword,
                ]);   

            } // end for


        }   
        */      
         
        Session::flash('message', 'La marca &laquo;'. $request['str_marca'] .'&raquo;, ha sido Actualizada Exitosamente');        
        return Redirect::route('marca.edit',$id);
    }

    public function status($id)
    {        
        $marca = Marca::findOrFail($id);           
        return view('marca.status',['marca'=>$marca])->with('page_title', 'Estado');
    }

    public function statusChange($id, Request $request)
    {
        $this->validate($request, [
            'bol_eliminado'         => 'required|boolean',            
        ]);             
        $marca = Marca::find($id);
        $marca->fill($request->all());
        $marca->save();
        Session::flash('message', 'La Marca ha cambiado de Estado');
        return Redirect::route('marca.status',$id);       
    }

    public function delete($id){   
        // Consulta la tabla Marcas 
        $marca = Marca::findOrFail($id);
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
                 
        return view('marca.delete',['marca'=>$marca,'tipos'=>$tipos])->with('page_title', 'Eliminar');                 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $tipos_marca = DB::table('tbl_tipos_marcas')->where('lng_idmarca', '=', $id)->delete();
        $delete = Marca::destroy($id);        
        Session::flash('message', 'Marca Eliminada Exitosamente');
        return Redirect::route('marca.index');
    }
    
    public function mobile()
    {   
        $filtro= 154; // id Moviles        
        $marcas= DB::table('tbl_tipos_marcas')
        ->where('lng_idtipo',$filtro)
        ->join('cat_marcas', 'tbl_tipos_marcas.lng_idmarca', '=', 'cat_marcas.id')
        ->select(
            'cat_marcas.*'                         
                )
        ->get(); 
        
        foreach ($marcas as $key => $value) {                    
            // Detectando el Tipo de Formato del la Imagen              
            $a = base64_decode($value->blb_img);
            $b = finfo_open();            
            //Agregando un nuevo atributo al array
            $value->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);   
            //return $value->format;         
        }  
        
        return view('marca.mobile',compact('marcas'))->with('page_title', 'Principal');
    }

    public function vehicle()
    {   
        $filtro= 154; // id Moviles                
        $marcas= DB::table('tbl_tipos_marcas')
        ->whereNotIn('lng_idtipo',[$filtro])
        ->join('cat_marcas', 'tbl_tipos_marcas.lng_idmarca', '=', 'cat_marcas.id')
        ->select(
            'cat_marcas.*'                         
                )
        ->distinct()
        ->get(); 
        
        foreach ($marcas as $key => $value) {                    
            // Detectando el Tipo de Formato del la Imagen              
            $a = base64_decode($value->blb_img);
            $b = finfo_open();            
            //Agregando un nuevo atributo al array
            $value->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);                        
        }          
        return view('marca.vehicle',compact('marcas'))->with('page_title', 'Principal');
    }

    public function prueba()
    {
        return view('marca.prueba');
    }

    public function editSEO($id)
    {    
        //$prueba = DB::table('tbl_tipos_marcas')->where('lng_idmarca',$id)->orderBy('id')->select('id','str_meta_descripcion','str_meta_keyword')->get();
        //return $prueba[0]->id;    
        // Consulta la tabla Marcas 
        $marca = Marca::findOrFail($id);

        $a = base64_decode($marca->blb_img);
        $b = finfo_open(); 
        $marca->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);
        // Consulta los Tipos Asociados a la Marca       
        $tipos= DB::table('tbl_tipos_marcas')        
        ->where('lng_idmarca',$id)
        ->join('cat_datos_maestros', 'tbl_tipos_marcas.lng_idtipo', '=', 'cat_datos_maestros.id')
        ->select(            
            'cat_datos_maestros.str_descripcion',
            'tbl_tipos_marcas.str_meta_descripcion',
            'tbl_tipos_marcas.id as id_tipo',
            'tbl_tipos_marcas.str_meta_keyword'
                )         
        ->get();                               
        return view('marca.edit_seo',['marca'=>$marca,'tipos'=>$tipos])->with('page_title', 'Editar SEO');
    }

    public function updateSEO($id, Request $request)
    {
        //print_r($_POST);die();        
        for ($i=0; $i < count($request->id_tipo); $i++) { 
            /*
            echo "ID Marca: " . $id . "<br>";
            echo "ID Tipo Asociado: ". $request->id_tipo[$i] . "<br>";
            echo "Valor Meta Descripcion: " . $request->str_meta_descripcion[$request->id_tipo[$i]] . "<br>";
            echo "Valor Meta Keywords: " . $request->str_meta_keyword[$request->id_tipo[$i]] . "<br>";            
            echo "<hr>";
            */            
            $id_tipo = $request->id_tipo[$i];
            $tipo_marca = DB::table('tbl_tipos_marcas')
            ->where('id', $request->id_tipo[$i])
            ->where('lng_idmarca', $id)
            ->update(
                    array(
                        'str_meta_descripcion' => $request->str_meta_descripcion[$id_tipo],
                        'str_meta_keyword' => $request->str_meta_keyword[$id_tipo]
                        )
                    );            
        }        
        Session::flash('message', 'Informacion Actualizada de forma Exitosa');        
        return Redirect::route('marca.edit_seo',$id);
    }

    public function ajaxGlobal($valor)
    {
        //$marcas = DB::table('cat_marcas')->select('id', 'str_marca','bol_eliminado')->take(50)->get();
        //$marcas = DB::table('cat_marcas')->select('id', 'str_marca','bol_eliminado')->orderBy('str_marca')->skip($valor)->take(50)->get();
        $marcas = DB::table('cat_marcas')->select('id', 'str_marca','bol_eliminado','blb_img')->orderBy('str_marca')->skip($valor)->take(50)->get();
        foreach ($marcas as $key => $value) {                    
            // Detectando el Tipo de Formato del la Imagen              
            $a = base64_decode($value->blb_img);
            $b = finfo_open();            
            //Agregando un nuevo atributo al array
            $value->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);   
            //return $value->format;         
        }
        $k = $valor + 1;
        return view('marca.marca-filtro',['marcas'=>$marcas,'k'=>$k]);
        //return $valor . "---" . $valor2;
        //$marcas = DB::table('cat_marcas')->select('str_marca')->take($valor)->get();
        //return $marcas;
    }

    

}


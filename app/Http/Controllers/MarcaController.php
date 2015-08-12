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
        $marcas = Marca::All();       

        foreach ($marcas as $key => $value) {                    
            // Detectando el Tipo de Formato del la Imagen              
            $a = base64_decode($value->blb_img);
            $b = finfo_open();            
            //Agregando un nuevo atributo al array
            $value->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);                       
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
        $tipo = DB::table('tbl_tipos_marcas')->where('lng_idmarca',$id)->orderBy('id')->select('id')->get();
        $contador = count($tipo);
        
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
            TipoMarca::create([
                'lng_idmarca'           => $id,
                'lng_idtipo'            => $tipo,               
                ]);    
            } // end for
        }      
             
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
        //return $id;
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
        return view('marca.edit_seo',['marca'=>$marca,'tipos'=>$tipos])->with('page_title', 'Editar');
    }


}


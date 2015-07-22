<?php

namespace Troovami\Http\Controllers;

use Illuminate\Http\Request;

use Troovami\Http\Requests;
use Troovami\Http\Controllers\Controller;
use Troovami\Marca;
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
        $marcas= DB::table('cat_marcas')
        ->join('cat_datos_maestros', 'cat_marcas.lng_idtipo', '=', 'cat_datos_maestros.id')
        ->select(
            'cat_datos_maestros.str_tipo', 
            'cat_marcas.id',
            'cat_marcas.str_marca',            
            'cat_marcas.bol_eliminado',
            'cat_marcas.blb_img'            
                )
        ->get(); 

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
        $tipo = DB::table('cat_datos_maestros')->whereIn('str_tipo',['mobile','vehiculos'])->orderBy('str_tipo')->lists('str_tipo','id');
        //return $tipo;
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
            'lng_idtipo'           => 'required',
            'blb_img'              => 'required|image|mimes:jpeg,png',
            'str_friendly_url'     => 'required|unique:cat_marcas|regex:/^[a-z\d_]{2,50}$/i', 
            'str_meta_descripcion' => 'required|max:255',
            'str_meta_keyword'     => 'required|max:255',            
        ]);
        Marca::create([
            'str_marca'            => ucfirst(strtolower($request['str_marca'])),            
            'blb_img'              => base64_encode(file_get_contents($request['blb_img'])),
            'lng_idtipo'           => $request['lng_idtipo'],
            'str_friendly_url'     => $request['str_friendly_url'],
            'str_meta_descripcion' => $request['str_meta_descripcion'],
            'str_meta_keyword'     => $request['str_meta_keyword'],
            'str_website'          => $request['str_website'],

        ]);     
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
        $marca= DB::table('cat_marcas')->where('cat_marcas.id', '=',$id)
        ->join('cat_datos_maestros', 'cat_marcas.lng_idtipo', '=', 'cat_datos_maestros.id')
        ->select(
            'cat_datos_maestros.str_tipo', 
            'cat_marcas.id',
            'cat_marcas.str_marca',            
            'cat_marcas.bol_eliminado',
            'cat_marcas.str_friendly_url',
            'cat_marcas.str_meta_descripcion',
            'cat_marcas.str_meta_keyword',
            'cat_marcas.str_website',
            'cat_marcas.blb_img'
                )
        ->get(); 
        foreach ($marca as $key => $value) {                    
            // Detectando el Tipo de Formato del la Imagen              
            $a = base64_decode($value->blb_img);
            $b = finfo_open();            
            //Agregando un nuevo atributo al array
            $value->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);            
            $value->str_tipo = ucfirst(strtolower($value->str_tipo));
        }         
        return view('marca.show',['marca'=>$marca])->with('page_title', 'Consultar');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {        
        $tipo = DB::table('cat_datos_maestros')->whereIn('str_tipo',['mobile','vehiculos'])->orderBy('str_tipo')->lists('str_tipo','id');
        $marca = Marca::findOrFail($id);
        $a = base64_decode($marca->blb_img);
        $b = finfo_open(); 
        $marca->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);
        return view('marca.edit',['marca'=>$marca],compact('tipo'))->with('page_title', 'Editar');
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
            'lng_idtipo'           => 'required',
            'blb_img'              => 'image|mimes:jpeg,png',
            'str_friendly_url'     => 'required|regex:/^[a-z\d_]{2,50}$/i|unique:cat_marcas,str_friendly_url,'. $id, 
            'str_meta_descripcion' => 'required|max:255',
            'str_meta_keyword'     => 'required|max:255',            
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
            'str_meta_descripcion' => $request['str_meta_descripcion'],
            'str_meta_keyword'     => $request['str_meta_keyword'],
            'str_website'          => $request['str_website'],
            ]);
        }                 
        $marca->save();

             
        Session::flash('message', 'La marca &laquo;'. $request['str_marca'] .'&raquo;, ha sido Registrada Exitosamente');        
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
        $marca= DB::table('cat_marcas')->where('cat_marcas.id', '=',$id)
        ->join('cat_datos_maestros', 'cat_marcas.lng_idtipo', '=', 'cat_datos_maestros.id')
        ->select(
            'cat_datos_maestros.str_tipo', 
            'cat_marcas.id',
            'cat_marcas.str_marca',            
            'cat_marcas.bol_eliminado',
            'cat_marcas.str_friendly_url',
            'cat_marcas.str_meta_descripcion',
            'cat_marcas.str_meta_keyword',
            'cat_marcas.str_website',
            'cat_marcas.blb_img'
                )
        ->get(); 
        foreach ($marca as $key => $value) {                    
            // Detectando el Tipo de Formato del la Imagen              
            $a = base64_decode($value->blb_img);
            $b = finfo_open();            
            //Agregando un nuevo atributo al array
            $value->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);            
            $value->str_tipo = ucfirst(strtolower($value->str_tipo));
        }         
        return view('marca.delete',['marca'=>$marca])->with('page_title', 'Eliminar');                 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Marca::destroy($id);
        Session::flash('message', 'Marca Eliminada Exitosamente');
        return Redirect::route('marca.index');
    }
}

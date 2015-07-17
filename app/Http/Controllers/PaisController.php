<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pais;
use Session;
use Redirect;
use DB;


class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {        
        $paises = Pais::All();  

		foreach ($paises as $key => $value) {        
        	// Detectando el Tipo de Formato del la Imagen        		
			$a = base64_decode($value['blb_img']);
        	$b = finfo_open();
        	$type = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);
        	// Agregando un nuevo atributo al array
			$value['format'] = $type;
		}        
		return view('pais.pais',compact('paises'))->with('page_title', 'Principal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('pais.create')->with('page_title', 'Agregar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
	        'str_paises'         => 'required|unique:cat_paises',            
	        'blb_img'         => 'required|image',
    	]);        
        Pais::create([
            'str_paises'         => ucfirst(strtolower($request['str_paises'])),
            'blb_img'         => addslashes(file_get_contents($request['blb_img'])),
        ]);     
		Session::flash('message', 'El Pais(a) &laquo;'. $request['str_paises'] .'&raquo;, ha sido Registrado Exitosamente');        
        return Redirect::route('pais.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $pais = Pais::findOrFail($id);  
        return view('pais.show',['pais'=>$pais])->with('page_title', 'Consultar');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $pais = Pais::findOrFail($id);        
        return view('pais.edit',['pais'=>$pais])->with('page_title', 'Editar');        
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
	        'str_paises'         => 'required|max:255|unique:cat_paises,str_paises,'.$id,	        
	        'blb_img'         => 'image',
    	]); 
    	$pais = Pais::find($id); 
    	if($request['blb_img']==""){    		
    		$pais->fill($request->all());
    	}else {
    		$pais->fill([
            'str_paises'  => ucfirst(strtolower($request['str_paises'])),
            'blb_img'     => base64_encode(file_get_contents($request['blb_img'])),
        	]);
        }  	              
        $pais->save();
        Session::flash('message', 'Pais Actualizado Exitosamente');
        return Redirect::route('pais.edit',$id);
    }

    public function status($id)
    {        
        $pais = Pais::findOrFail($id);           
        return view('pais.status',['pais'=>$pais])->with('page_title', 'Estado');
    }

    public function statusChange($id, Request $request)
    {
        $this->validate($request, [
            'bol_eliminado'         => 'required|boolean',            
        ]);             
        $user = Pais::find($id);
        $user->fill($request->all());
        $user->save();
        Session::flash('message', 'El Pais ha cambiado de Estado');
        return Redirect::route('pais.status',$id);       
    }
}

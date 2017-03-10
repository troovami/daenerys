<?php

namespace Troovami\Http\Controllers;

use Illuminate\Http\Request;

use Troovami\Http\Requests;
use Troovami\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Troovami\Noticia;
use Troovami\NoticiaPais;
use Troovami\NoticiaVocabulario;
use Troovami\NoticiasImagenes;
use Session;
use Redirect;
use DB;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {   
        $noticias = Noticia::All(); 
        return view('noticia.noticia',compact('noticias'))->with('page_title', 'Principal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('noticia.create')->with('page_title', 'Agregar');  
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */

    public function store(Request $request)
    {
        $id_admin = Auth::id();

        $this->validate($request, [                 
            'str_titulo'            => 'required|unique:tbl_noticias',
            'str_contenido'         => 'required|unique:tbl_noticias',
            'blb_img'               => 'required|mimes:jpeg,png',
        ]);

        
        // Creando la Noticia
        $noticia = Noticia::create([
            'str_titulo'            => ucfirst(strtolower($request['str_titulo'])),            
            'str_contenido'         => $request['str_contenido'],
            'lng_idtipo'            =>  0,
            'str_friendly_url'      =>  "",
            'str_meta_descripcion'  =>  "",
            'str_meta_keyword'      =>  "",
            'lng_idempresa'         =>  0,
            'lng_idadmin'           =>  $id_admin,
            'bol_eliminado'         =>  0,
        ]);

        $id_noticia = $noticia->id;

        $imagenes = NoticiasImagenes::create([
            'lng_idnoticias'       => $id_noticia,
            'blb_img'              => base64_encode(file_get_contents($request['blb_img'])),
            'int_peso'             => $request['int_peso'],
            'bol_eliminado'        => 0,

        ]);


       //obtenemos el campo file definido en el formulario
       $file = $request->file('blb_img');
 
       //obtenemos el nombre del archivo
       $nombre = $file->getClientOriginalName();
 
       //indicamos que queremos guardar un nuevo archivo en el disco local
       \Storage::disk('local')->put($nombre,  \File::get($file));

        
        Session::flash('message', 'La noticia &laquo;'. $request['str_titulo'] .'&raquo;, ha sido Registrada Exitosamente');        
        return Redirect::route('noticia.create');
    } 
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // Consulta la tabla Noticia 
        $noticia = Noticia::findOrFail($id);
        $contenido=$noticia->str_contenido;
        $contenido=strip_tags($contenido);
        $contenido = trim($contenido, " \r.\n.");
        return view('noticia.show',['noticia'=>$noticia,'contenido'=>$contenido])->with('page_title', 'Consultar');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {     
        // Consulta la tabla Noticia 
        $noticia = Noticia::findOrFail($id);
        return view('noticia.edit',['noticia'=>$noticia])->with('page_title', 'Editar');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $noticia = Noticia::find($id);
        $noticia->fill($request->all());
        $noticia->save();
        Session::flash('message', 'La Noticia &laquo;'. $request['str_titulo'] .'&raquo;, ha sido Actualizada Exitosamente');        
        return Redirect::route('noticia.edit',$id);
    }

    public function status($id)
    {        
        $noticia = Noticia::findOrFail($id);           
        return view('noticia.status',['noticia'=>$noticia])->with('page_title', 'Estado');
    }

    public function statusChange($id, Request $request)
    {
        $this->validate($request, [
            'bol_eliminado'         => 'required|boolean',            
        ]);             
        $noticia = Noticia::find($id);
        $noticia->fill($request->all());
        $noticia->save();
        Session::flash('message', 'La Noticia ha cambiado de Estado');
        return Redirect::route('noticia.status',$id);       
    }

    public function delete($id)
    {   
        // Consulta la tabla Noticia 
        $noticia = Noticia::findOrFail($id);
        return view('noticia.delete',['noticia'=>$noticia])->with('page_title', 'Eliminar');                 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $delete = Noticia::destroy($id);        
        Session::flash('message', 'Noticia Eliminada Exitosamente');
        return Redirect::route('noticia.index');
    }
    
}


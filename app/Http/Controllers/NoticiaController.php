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
use Troovami\Pais;
use Troovami\Vocabulario;
use Session;
use Redirect;
use DB;
use Storage;

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
        $paises= DB::table('cat_paises')
        ->select(
            'cat_paises.str_paises as pais',
            'cat_paises.id as id_pais'
        )
        ->distinct()
         ->get();

        $vocabulario= DB::table('tbl_vocabularios')
        ->select(
            'tbl_vocabularios.str_vocabulario as vocabulario',
            'tbl_vocabularios.id as id_vocabulario'
        )
        ->distinct()
        ->get();

        return view('noticia.create',['paises'=>$paises,'vocabulario'=>$vocabulario])->with('page_title', 'Agregar');  
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */

    public function store(Request $request)
    {
        $id_admin = Auth::id();

        /*$this->validate($request, [                 
            'str_titulo'            => 'required|unique:tbl_noticias',
            'str_contenido'         => 'required|unique:tbl_noticias',
            'blb_img'               => 'required|mimes:jpeg,png',
        ]);*/

        
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

         $noticiaPais = NoticiaPais::create([
            'lng_idnoticia'         => $id_noticia,
            'lng_idpais'            => $request->input('lng_idpais'),
            'bol_eliminado'         => 0,
        ]);

          $noticiaVoc = NoticiaVocabulario::create([
           'lng_idnoticia'          => $id_noticia,
            'lng_idvocabulario'     => $request->input('lng_idvocabulario'),
            'bol_eliminado'         => 0,

        ]);


        for ($j = 0; $j < count($request->file('blb_img')); $j++)
        {   
            $path = "/home/angelo/Imágenes/daenerys/noticias/";

            //obtenemos el campo file definido en el formulario
            $file[] = $request->file('blb_img')[$j];

            //obtenemos el nombre del archivo
            $nombre[] = $file[$j]->getClientOriginalName();
            $extension[] = $file[$j]->getClientOriginalExtension();
            

            //indicamos que queremos guardar un nuevo archivo en el disco local

            $image[] = \Input::file('blb_img')[$j];
            $filename[]  = $id_noticia.'_'.$j.'.'.$extension[$j];
            $ruta[] = $path . $filename[$j];

            
            \Image::make($image[$j]->getRealPath())->resize(1000, 1500)->save($ruta[$j]);


            $imagenes = NoticiasImagenes::create([
                'lng_idnoticias'    =>  $id_noticia,
                'blb_img'           =>  $ruta[$j],                  
                'int_peso'          =>  $request->input('int_peso')[$j],
                'bol_eliminado'     =>  0,
            ]);

       }

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

        $noticiaVoc= DB::table('tbl_noticias_vocabularios')
        ->join('tbl_vocabularios', 'tbl_vocabularios.id', '=', 'tbl_noticias_vocabularios.lng_idvocabulario')
        ->where('tbl_noticias_vocabularios.lng_idnoticia', '=', $id)
        ->select(
            'tbl_vocabularios.str_vocabulario as vocabulario',
            'tbl_vocabularios.id as id_vocabulario'
            )
        ->get();


        $noticiaPais= DB::table('tbl_noticias_paises')
        ->join('cat_paises', 'cat_paises.id', '=', 'tbl_noticias_paises.lng_idpais')
        ->where('tbl_noticias_paises.lng_idnoticia', '=', $id)
        ->select(
            'cat_paises.str_paises as pais',
            'cat_paises.id as id_pais'
            )
        ->get();


        return view('noticia.show',['noticia'=>$noticia,'contenido'=>$contenido,'noticiaVoc'=>$noticiaVoc,'noticiaPais'=>$noticiaPais])->with('page_title', 'Consultar');
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

        $noticiaVoc= DB::table('tbl_vocabularios')
        ->leftjoin('tbl_noticias_vocabularios', 'tbl_vocabularios.id', '=', 'tbl_noticias_vocabularios.lng_idvocabulario')
        ->select(
            'tbl_vocabularios.str_vocabulario as vocabulario',
            'tbl_vocabularios.id as id_vocabulario'
            )
        ->lists('vocabulario','id_vocabulario');


        $noticiaPais= DB::table('cat_paises')
        ->leftjoin('tbl_noticias_paises', 'cat_paises.id', '=', 'tbl_noticias_paises.lng_idpais')
        ->select(
            'cat_paises.str_paises as pais',
            'cat_paises.id as id_pais'
            )
        ->lists('pais','id_pais');

        return view('noticia.edit',['noticia'=>$noticia,'noticiaVoc'=>$noticiaVoc,'noticiaPais'=>$noticiaPais])->with('page_title', 'Editar');
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


        $noticiaVoc = NoticiaVocabulario::findOrFail($id);
        $noticiaVoc->fill($request->all());
        $noticiaVoc->save();

        $noticiaPais = NoticiaPais::findOrFail($id);
        $noticiaPais->fill($request->all());
        $noticiaPais->save();

        //$noticiaImg = NoticiasImagenes::findOrFail($id);

        /*$imagenes = NoticiasImagenes::find($id);        
        if($request['blb_img']=="")
        {            
            $imagenes->fill($request->all());                
        }
        else 
        {   
            Storage::delete("noticia_".$id.".png");
            $imagenes->fill([
            'blb_img'              => base64_encode(file_get_contents($request['blb_img']))          
            ]);
        }                 
           
        $imagenes->save(); 

        //obtenemos el campo file definido en el formulario
       $file = $request->file('blb_img');

       //obtenemos el nombre del archivo
       $nombre = $file->getClientOriginalName();
       $extension = substr(strtolower($nombre),-4);
 
       //indicamos que queremos guardar un nuevo archivo en el disco local
       \Storage::disk('local')->put("noticia_".$id_noticia.$extension,  \File::get($file));*/


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


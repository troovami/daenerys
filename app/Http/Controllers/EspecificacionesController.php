<?php

namespace Troovami\Http\Controllers;

use Illuminate\Http\Request;

use Troovami\Http\Requests;
use Troovami\Http\Controllers\Controller;
use Troovami\Maestro;
use Troovami\Frecuencias;
use Troovami\Tecnologias;
use Troovami\TecnologiaFrecuencia;
use Troovami\Operadoras;
use Troovami\OperadoraPais;
use Troovami\OperadoraTecnologiaFrecuencia;
use Troovami\Pais;
use Session;
use Redirect;
use DB;

class EspecificacionesController extends Controller
{   
    public function redes()
    {   
        return view('especificaciones/redes.index')->with('page_title', 'Principal');
    }
    
    public function tecnologia()
    {   
         $tecnologia = DB::table('cat_tecnologias')
       ->select('id','lng_idgeneracion','str_especificaciones','str_description','bol_eliminado')
       ->orderBy('str_especificaciones')
       ->get();
        
        $count = DB::table('cat_tecnologias')->count(); // Cantidad de Marcas ej: 1000 marcas        
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
                    

            }else {
                $paginado['recorrido']  = $paginado['incremento'] - $paginado['filtro'];
                $paginado['numeracion']++;
                $filtro[] = 
                    [ 
                        'numeracion' => $paginado['numeracion'],
                        'skip'       => $paginado['recorrido'],
                        'take'       => $paginado['filtro']
                    ];   
                    
            }
        }        
        // Fin Paginador       
        return view('especificaciones/redes.tecnologia',['tecnologia'=>$tecnologia,'filtro'=>$filtro, 'total'=>$count])->with('page_title', 'Principal');
        //return view('especificaciones/redes.tecnologia')->with('page_title', 'Principal');
    }

    public function create_tecnologia()
    {
        return view('especificaciones/redes.create_tecnologia')->with('page_title', 'Agregar');  
    }

   
    public function store_tecnologia(Request $request)
    {
        
        $this->validate($request, [  
            'str_description' => 'required|unique:cat_tecnologias,str_description,'
        ]);

        // Creando el Color
        $tecnologia = Tecnologias::create([
            'lng_idgeneracion'       => 1,
            'str_especificaciones'   => $request['str_especificaciones'], 
            'str_description'        => $request['str_description'],
            'bol_eliminado'          => 0
        ]);
        
        Session::flash('message', 'La Tecnología &laquo;'. $request['str_description'] .'&raquo;, ha sido Registrada Exitosamente');        
        return Redirect::route('redes.create_tecnologia');
    } 

    public function edit_tecnologia($id)
    {     
        // Consulta la tabla Datos Maestros 
        $tecnologia = Tecnologias::findOrFail($id);
        return view('especificaciones/redes.edit_tecnologia',['tecnologia'=>$tecnologia])->with('page_title', 'Editar');
    }

    public function update_tecnologia($id, Request $request)
    {
        $this->validate($request, [               
            'str_especificaciones'  => 'required|unique:cat_tecnologias,str_especificaciones,'. $id,
            'str_description'       => 'required|unique:cat_tecnologias,str_description,'. $id
        ]);  
        // Actualiza El Tipo de Sim Card
        $tecnologia = Tecnologias::find($id);
        if($request['str_especificaciones']==""){            
            $tecnologia->fill($request->all());                
        }else {

            $tecnologia->fill([
            'str_especificaciones'   => $request['str_especificaciones'],
            'str_description'        => $request['str_description'],
            ]);
            
        }         
        $tecnologia->save(); 
          
        Session::flash('message', 'La Tecnología &laquo;'. $request['str_description'] .'&raquo;, ha sido Actualizado Exitosamente');        
        return Redirect::route('redes.edit_tecnologia',$id);
    }

    public function show_tecnologia($id)
    {
        // Consulta la tabla Datos Maestros 
        $tecnologia = Tecnologias::findOrFail($id);
        return view('especificaciones/redes.show_tecnologia',['tecnologia'=>$tecnologia])->with('page_title', 'Consultar');
    }

    public function status_tecnologia($id)
    {        
        $tecnologia = Tecnologias::findOrFail($id);           
        return view('especificaciones/redes.status_tecnologia',['tecnologia'=>$tecnologia])->with('page_title', 'Estado');
    }

    public function statusChange_tecnologia($id, Request $request)
    {
        $this->validate($request, [
            'bol_eliminado'         => 'required|boolean',            
        ]);             
        $tecnologia = Tecnologias::find($id);
        $tecnologia->fill($request->all());
        $tecnologia->save();
        Session::flash('message', 'La Tecnología ha cambiado de Estado');
        return Redirect::route('redes.status_tecnologia',$id);       
    }

    public function delete_tecnologia($id)
    {   
        // Consulta la tabla Datos Maestros 
        $tecnologia = Tecnologias::findOrFail($id);
        return view('especificaciones/redes.delete_tecnologia',['tecnologia'=>$tecnologia])->with('page_title', 'Eliminar');
    }

    public function destroy_tecnologia($id)
    {
        $delete = Tecnologias::destroy($id);        
        Session::flash('message', 'Tecnología Eliminada Exitosamente');
        return Redirect::route('redes.tecnologia');
    }

    public function bandas()
    {   
        $bandas = DB::table('cat_frecuencias')
       ->select('id','str_frecuecia','bol_eliminado')
       ->orderBy('str_frecuecia')
       ->get();
        
        $count = DB::table('cat_frecuencias')->count(); // Cantidad de Marcas ej: 1000 marcas        
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
                    

            }else {
                $paginado['recorrido']  = $paginado['incremento'] - $paginado['filtro'];
                $paginado['numeracion']++;
                $filtro[] = 
                    [ 
                        'numeracion' => $paginado['numeracion'],
                        'skip'       => $paginado['recorrido'],
                        'take'       => $paginado['filtro']
                    ];   
                    
            }
        }        
        // Fin Paginador       
        return view('especificaciones/redes.bandas',['bandas'=>$bandas,'filtro'=>$filtro, 'total'=>$count])->with('page_title', 'Principal');
    }

    public function create_banda()
    {
        return view('especificaciones/redes.create_banda')->with('page_title', 'Agregar');  
    }

   
    public function store_banda(Request $request)
    {
        
        $this->validate($request, [  
            'str_frecuecia' => 'required|unique:cat_frecuencias,str_frecuecia,'
        ]);

        // Creando el Color
        $frecuencia = Frecuencias::create([
            'str_frecuecia'          => $request['str_frecuecia'], 
            'bol_eliminado'          => 0
        ]);
        
        Session::flash('message', 'La Frecuencia &laquo;'. $request['str_frecuecia'] .'&raquo;, ha sido Registrada Exitosamente');        
        return Redirect::route('redes.create_banda');
    } 

    public function edit_banda($id)
    {     
        // Consulta la tabla Datos Maestros 
        $banda = Frecuencias::findOrFail($id);
        return view('especificaciones/redes.edit_banda',['banda'=>$banda])->with('page_title', 'Editar');
    }

    public function update_banda($id, Request $request)
    {
        $this->validate($request, [               
            'str_frecuecia'  => 'required|unique:cat_frecuencias,str_frecuecia,'. $id
        ]);  
        // Actualiza El Tipo de Sim Card
        $banda = Frecuencias::find($id);
        if($request['str_frecuecia']==""){            
            $banda->fill($request->all());                
        }else {

            $banda->fill([
            'str_frecuecia'   => $request['str_frecuecia']
            ]);
            
        }         
        $banda->save(); 
          
        Session::flash('message', 'La Banda &laquo;'. $request['str_frecuecia'] .'&raquo;, ha sido Actualizado Exitosamente');        
        return Redirect::route('redes.edit_banda',$id);
    }

    public function show_banda($id)
    {
        // Consulta la tabla Datos Maestros 
        $banda = Frecuencias::findOrFail($id);
        return view('especificaciones/redes.show_banda',['banda'=>$banda])->with('page_title', 'Consultar');
    }

    public function status_banda($id)
    {        
        $banda = Frecuencias::findOrFail($id);           
        return view('especificaciones/redes.status_banda',['banda'=>$banda])->with('page_title', 'Estado');
    }

    public function statusChange_banda($id, Request $request)
    {
        $this->validate($request, [
            'bol_eliminado'         => 'required|boolean',            
        ]);             
        $banda = Frecuencias::find($id);
        $banda->fill($request->all());
        $banda->save();
        Session::flash('message', 'La Banda ha cambiado de Estado');
        return Redirect::route('redes.status_banda',$id);       
    }

    public function delete_banda($id)
    {   
        // Consulta la tabla Datos Maestros 
        $banda = Frecuencias::findOrFail($id);
        return view('especificaciones/redes.delete_banda',['banda'=>$banda])->with('page_title', 'Eliminar');
    }

    public function destroy_banda($id)
    {
        $delete = Frecuencias::destroy($id);        
        Session::flash('message', 'Banda Eliminada Exitosamente');
        return Redirect::route('redes.bandas');
    }

    public function tecno_frec()
    {   
        $tecno_frec = DB::table('cat_tecnologias_frecuencias')
        ->join('cat_frecuencias', 'cat_tecnologias_frecuencias.lng_idfrecuencia', '=', 'cat_frecuencias.id')
        ->join('cat_tecnologias', 'cat_tecnologias_frecuencias.lng_idtecnologia', '=', 'cat_tecnologias.id')
        ->select(
            'cat_tecnologias_frecuencias.id',
            'cat_frecuencias.str_frecuecia',
            DB::raw('CONCAT(cat_tecnologias.str_especificaciones, " ", cat_tecnologias.str_description) AS tecnologia_full'),
            'cat_tecnologias_frecuencias.bol_eliminado'
            )
        ->orderBy('tecnologia_full')
        ->get();

        $count = DB::table('cat_tecnologias_frecuencias')->count(); // Cantidad de Marcas ej: 1000 marcas        
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
                    

            }else {
                $paginado['recorrido']  = $paginado['incremento'] - $paginado['filtro'];
                $paginado['numeracion']++;
                $filtro[] = 
                    [ 
                        'numeracion' => $paginado['numeracion'],
                        'skip'       => $paginado['recorrido'],
                        'take'       => $paginado['filtro']
                    ];   
                    
            }
        }        
        // Fin Paginador       
        return view('especificaciones/redes.tecno_frec',['tecno_frec'=>$tecno_frec,'filtro'=>$filtro, 'total'=>$count])->with('page_title', 'Principal');
    }

    public function create_tecno_frec()
    {
        $tecnologias= DB::table('cat_tecnologias')
        ->select(
            DB::raw('CONCAT(cat_tecnologias.str_especificaciones, " ", cat_tecnologias.str_description) AS tecnologia_full'),
            'cat_tecnologias.id as id_tecnologia'
            )
        ->orderBy('tecnologia_full')
        ->lists('tecnologia_full','id_tecnologia');

        $frecuencias= DB::table('cat_frecuencias')
        ->select(
            'cat_frecuencias.str_frecuecia as frecuencia',
            'cat_frecuencias.id as id_frecuencia'
            )
        ->orderBy('frecuencia')
        ->lists('frecuencia','id_frecuencia');

        return view('especificaciones/redes.create_tecno_frec',['frecuencias'=>$frecuencias,'tecnologias'=>$tecnologias])->with('page_title', 'Agregar');  
    }

   
    public function store_tecno_frec(Request $request)
    {
         $validate= TecnologiaFrecuencia::where('lng_idtecnologia','=',$request['lng_idtecnologia'])
        ->where('lng_idfrecuencia','=',$request['lng_idfrecuencia'])
        ->get();
            
            if(count($validate)==0)
            {
                // Creando Tecno Frecuencia
                $tecno_frec = TecnologiaFrecuencia::create([
                    'lng_idtecnologia'          => $request['lng_idtecnologia'],
                    'lng_idfrecuencia'          => $request['lng_idfrecuencia'],
                    'bol_eliminado'             => 0
                ]);
        

                Session::flash('message', 'La Tecnología/Frecuencia, ha sido Registrada Exitosamente'); 
            }
            else
            {
                Session::flash('message', 'La Tecnología/Frecuencia ya ha sido Registrada, intente con otra.');
            }

               
        return Redirect::route('redes.create_tecno_frec');
    } 

    public function edit_tecno_frec($id)
    {     
        return view('especificaciones/redes.edit_tecno_frec',[])->with('page_title', 'Editar');
    }

    public function update_tecno_frec($id, Request $request)
    {
        Session::flash('message', 'La Tecnología/Frecuencia, ha sido Actualizado Exitosamente');        
        return Redirect::route('redes.edit_tecno_frec',$id);
    }

    public function delete_tecno_frec($id)
    {   
        // Consulta la tabla Cat Tecnologias Frecuencias
        $tecno_frec = TecnologiaFrecuencia::findOrFail($id);
        $tecnologia = Tecnologias::findOrFail($tecno_frec->lng_idtecnologia);
        $tecnologia_full = $tecnologia->str_especificaciones . " " .$tecnologia->str_description ;
        $frecuencia = Frecuencias::findOrFail($tecno_frec->lng_idfrecuencia);
        $frecuencia_full = $frecuencia->str_frecuecia;

        return view('especificaciones/redes.delete_tecno_frec',['tecno_frec'=>$tecno_frec,'tecnologia_full'=>$tecnologia_full,'frecuencia_full'=>$frecuencia_full])->with('page_title', 'Eliminar');
    }

    public function destroy_tecno_frec($id)
    {
        $delete = TecnologiaFrecuencia::destroy($id);        
        Session::flash('message', 'Tecnología Frecuencia Eliminada Exitosamente');
        return Redirect::route('redes.tecno_frec');
    }

    public function oper_tecno_frec()
    {   
        $oper_tecno_frec = DB::table('tbl_frecuencias_tecnos_operadoras')
        ->join('cat_tecnologias_frecuencias', 'tbl_frecuencias_tecnos_operadoras.lng_idfrecuencia_tecnologia', '=', 'cat_tecnologias_frecuencias.id')
        ->join('tbl_operadoras', 'tbl_frecuencias_tecnos_operadoras.lng_idoperadora', '=', 'tbl_operadoras.id')
        ->join('cat_frecuencias', 'cat_tecnologias_frecuencias.lng_idfrecuencia', '=', 'cat_frecuencias.id')
        ->join('cat_tecnologias', 'cat_tecnologias_frecuencias.lng_idtecnologia', '=', 'cat_tecnologias.id')
        ->select(
            'tbl_frecuencias_tecnos_operadoras.id as id',
            'tbl_operadoras.str_operadora as operadora',
            'cat_frecuencias.str_frecuecia as frecuencia',
            DB::raw('CONCAT(cat_tecnologias.str_especificaciones, " ", cat_tecnologias.str_description) AS tecnologia_full'),
            'tbl_frecuencias_tecnos_operadoras.bol_eliminado'
            )
        ->get();

        $count = DB::table('tbl_frecuencias_tecnos_operadoras')->count(); // Cantidad de Marcas ej: 1000 marcas        
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
                    

            }else {
                $paginado['recorrido']  = $paginado['incremento'] - $paginado['filtro'];
                $paginado['numeracion']++;
                $filtro[] = 
                    [ 
                        'numeracion' => $paginado['numeracion'],
                        'skip'       => $paginado['recorrido'],
                        'take'       => $paginado['filtro']
                    ];   
                    
            }
        }        
        // Fin Paginador       
        return view('especificaciones/redes.oper_tecno_frec',['oper_tecno_frec'=>$oper_tecno_frec,'filtro'=>$filtro, 'total'=>$count])->with('page_title', 'Principal');
    }

    public function create_oper_tecno_frec()
    {
        $operadora= DB::table('tbl_operadoras')
        ->select(
            'tbl_operadoras.id as id_operadora',
            'tbl_operadoras.str_operadora as operadora'
            )
        ->orderBy('operadora')
        ->lists('operadora','id_operadora');

        $tecno_frec= DB::table('cat_tecnologias_frecuencias')
        ->join('cat_frecuencias', 'cat_tecnologias_frecuencias.lng_idfrecuencia', '=', 'cat_frecuencias.id')
        ->join('cat_tecnologias', 'cat_tecnologias_frecuencias.lng_idtecnologia', '=', 'cat_tecnologias.id')
        ->select(
            DB::raw('CONCAT(cat_tecnologias.str_especificaciones, " ", cat_tecnologias.str_description, " en la Frecuencia ", cat_frecuencias.str_frecuecia) AS tecno_frec_full'),
            'cat_tecnologias_frecuencias.id as id_tecno_frec'
            )
        ->orderBy('tecno_frec_full')
        ->lists('tecno_frec_full','id_tecno_frec');



        return view('especificaciones/redes.create_oper_tecno_frec',['operadora'=>$operadora,'tecno_frec'=>$tecno_frec])->with('page_title', 'Agregar');  
    }

   
    public function store_oper_tecno_frec(Request $request)
    {
        $validate= OperadoraTecnologiaFrecuencia::where('lng_idoperadora','=',$request['lng_idoperadora'])
        ->where('lng_idfrecuencia_tecnologia','=',$request['lng_idfrecuencia_tecnologia'])
        ->get();
            
            if(count($validate)==0)
            {
                $oper_tecno_frec = OperadoraTecnologiaFrecuencia::create([
                'lng_idoperadora'                => $request['lng_idoperadora'],
                'lng_idfrecuencia_tecnologia'    => $request['lng_idfrecuencia_tecnologia'],
                'bol_eliminado'                  => 0
                ]);  

                Session::flash('message', 'La Operadora se le ha asociado una Tecnología y Frecuencia Exitosamente');
            }
            else
            {
                Session::flash('message', 'La Operadora tiene asociada una Tecnología y Frecuencia intente con otra.');   
            }
        
        return Redirect::route('redes.create_oper_tecno_frec');
    } 

    public function edit_oper_tecno_frec($id)
    {    

        return view('especificaciones/redes.edit_oper_tecno_frec',[])->with('page_title', 'Editar');
    }

    public function update_oper_tecno_frec($id, Request $request)
    {
        
        Session::flash('message', 'La Operadora se le ha asociado una Tecnología y Frecuencia, ha sido Actualizado Exitosamente');        
        return Redirect::route('redes.edit_oper_tecno_frec',$id);
    }

    public function delete_oper_tecno_frec($id)
    {   
        // Consulta la tabla Cat Tecnologias Frecuencias
        $oper_tecno_frec = OperadoraTecnologiaFrecuencia::findOrFail($id);
        $operadora = Operadoras::findOrFail($oper_tecno_frec->lng_idoperadora);
        $tecno_frec = TecnologiaFrecuencia::findOrFail($oper_tecno_frec->lng_idfrecuencia_tecnologia);
        $tecnologia = Tecnologias::findOrFail($tecno_frec->lng_idtecnologia);
        $tecnologia_full = $tecnologia->str_especificaciones . " " .$tecnologia->str_description ;
        $frecuencia = Frecuencias::findOrFail($tecno_frec->lng_idfrecuencia);
        $frecuencia_full = $frecuencia->str_frecuecia;

        return view('especificaciones/redes.delete_oper_tecno_frec',['oper_tecno_frec'=>$oper_tecno_frec,'operadora'=>$operadora,'tecnologia_full'=>$tecnologia_full,'frecuencia_full'=>$frecuencia_full])->with('page_title', 'Eliminar');
    }

    public function destroy_oper_tecno_frec($id)
    {
        $delete = OperadoraTecnologiaFrecuencia::destroy($id);        
        Session::flash('message', 'Tecnología/Frecuencia Eliminada Exitosamente');
        return Redirect::route('redes.oper_tecno_frec');
    }

    public function operadoras()
    {   
        /*$operadoras= DB::table('tbl_operadora_pais')        
        ->join('cat_paises', 'tbl_operadora_pais.lng_idpais', '=', 'cat_paises.id')
        ->join('tbl_operadoras', 'tbl_operadora_pais.lng_idoperadora', '=', 'tbl_operadoras.id')
        ->select( 
            'tbl_operadoras.id',
            'tbl_operadoras.str_operadora',
            'tbl_operadoras.blb_img as logo',
            'tbl_operadoras.bol_eliminado',
            'cat_paises.str_paises',
            'cat_paises.blb_img as pais'                                    
                ) 
        ->orderBy('tbl_operadoras.str_operadora')        
        ->get();*/

        $operadoras = DB::table('tbl_operadoras')
       ->select('id','str_operadora','blb_img as logo','bol_eliminado')
       ->orderBy('str_operadora')
       ->get();

        foreach ($operadoras as $key => $value) {                    
            // Detectando el Tipo de Formato del la Imagen              
            $a = base64_decode($value->logo);
            $b = finfo_open();            
            //Agregando un nuevo atributo al array
            $value->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE);   
            //return $value->format;         
        }

        $count = DB::table('tbl_operadoras')->count(); // Cantidad de Marcas ej: 1000 marcas        
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
                    

            }else {
                $paginado['recorrido']  = $paginado['incremento'] - $paginado['filtro'];
                $paginado['numeracion']++;
                $filtro[] = 
                    [ 
                        'numeracion' => $paginado['numeracion'],
                        'skip'       => $paginado['recorrido'],
                        'take'       => $paginado['filtro']
                    ];   
                    
            }
        }        
        // Fin Paginador       
        return view('especificaciones/redes.operadoras',['operadoras'=>$operadoras,'filtro'=>$filtro, 'total'=>$count])->with('page_title', 'Principal');
        //return view('especificaciones/redes.operadoras')->with('page_title', 'Principal');
    }

    public function create_operadora()
    {

        $paises= DB::table('cat_paises')
        ->select(
            'cat_paises.str_paises as nombre_pais',
            'cat_paises.id as id_pais'
        )
        ->distinct()
        ->lists('nombre_pais','id_pais');

        return view('especificaciones/redes.create_operadora',['paises'=>$paises])->with('page_title', 'Agregar');  
    }

   
    public function store_operadora(Request $request)
    {
        $this->validate($request, [
            'str_operadora'         => 'required|unique:tbl_operadoras,str_operadora',            
            'blb_img'               => 'required|mimes:jpeg,png',
        ]); 
        
        $operadora = Operadoras::create([
            'str_operadora'         => $request['str_operadora'],
            'blb_img'               => base64_encode(file_get_contents($request['blb_img'])),
            'bol_eliminado'         => 0
        ]);

        // Id de la Operadora
        $lastInsertedId = $operadora->id; 
        // Creando Paises Asociado a la Operadora
        $paises = $request->lng_idpais;
        $contador = count($paises);
        for ($i=0; $i < $contador; $i++) {             
            $paises[$i];                       
            OperadoraPais::create([
                'lng_idoperadora'       => $lastInsertedId,
                'lng_idpais'            => $paises[$i],               
            ]); 
            
        }
        
        /*$frecuencias = array($request->frecuencia);
        $tecnologias = array($request->tecnologia);

        $contadorFrecuencias = count($frecuencias);
        for($j=0;$j < $contadorFrecuencias; $j++)
        {
            $frecuencias[$j];
            TecnologiaFrecuencia::create([
                'lng_idtecnologia'      =>   $request['lng_idtecnologia'],
                'lng_idfrecuencia'      =>   $request['lng_idfrecuencia']
                ]);
        }

        $tecnologiaFrecuencia = TecnologiaFrecuencia::create([
            


        ]);*/


        
        Session::flash('message', 'La Operadora &laquo;'. $request['str_operadora'] .'&raquo;, ha sido Registrada Exitosamente');        
        return Redirect::route('redes.create_operadora');

    } 

    public function show_operadora($id)
    {
        $operadora = Operadoras::findOrFail($id);

        $operpais= DB::table('tbl_operadora_pais')   
        ->where('tbl_operadoras.str_operadora',$operadora->str_operadora)     
        ->join('cat_paises', 'tbl_operadora_pais.lng_idpais', '=', 'cat_paises.id')
        ->join('tbl_operadoras', 'tbl_operadora_pais.lng_idoperadora', '=', 'tbl_operadoras.id')
        ->select( 
            'tbl_operadoras.id',
            'tbl_operadoras.str_operadora',
            'tbl_operadoras.blb_img as logo',
            'tbl_operadoras.bol_eliminado',
            'cat_paises.str_paises',
            'cat_paises.blb_img as pais'                                    
                ) 
        ->get();

        return view('especificaciones/redes.show_operadora',['operpais'=>$operpais])->with('page_title', 'Consultar');
    }


    public function edit_operadora($id)
    {     
        // Consulta la tabla Datos Maestros 
        $operadora = Operadoras::findOrFail($id);


        $paises= DB::table('cat_paises')
        ->select(
            'cat_paises.str_paises as nombre_pais',
            'cat_paises.id as id_pais'
        )
        ->distinct()
        ->lists('nombre_pais','id_pais');


        $operadora_pais= DB::table('tbl_operadora_pais')        
        ->where('lng_idoperadora',$id)
        ->join('cat_paises', 'tbl_operadora_pais.lng_idpais', '=', 'cat_paises.id')
        ->select(            
            'cat_paises.id'                        
                )         
        ->get(); 
        
         // Asigna un nuevo atributo a los tipos asociados a la Operadora
        for ($i=0; $i < count($paises); $i++) { 
            $paises[$i]->attrib = '';
        }

        // Todos los Paises
        for ($i=0; $i < count($paises); $i++) 
        { 
            // Paises Asociados a la Operadora
            for ($q=0; $q < count($operadora_pais); $q++) 
            { 
                if ($operadora_pais[$q]->id == $paises[$i]->id) 
                {
                    // Atributo
                    $paises[$i]->attrib = 'selected="selected"';
                }
            } // for            
        } // for    




        return view('especificaciones/redes.edit_operadora',['operadora'=>$operadora,'paises'=>$paises])->with('page_title', 'Editar');
    }

    public function update_operadora($id, Request $request)
    {
        $this->validate($request, [
            'str_operadora'   => 'required|unique:tbl_operadoras,str_operadora,'.$id,           
            'blb_img'         => 'image',
        ]); 
        $operadora = Operadoras::find($id); 
        if($request['blb_img']==""){            
            $operadora->fill($request->all());
        }else {
            $operadora->fill([
            'str_operadora'  => $request['str_operadora'],
            'blb_img'     => base64_encode(file_get_contents($request['blb_img'])),
            ]);
        }                 
        $operadora->save();

        Session::flash('message', 'La Operadora &laquo;'. $request['str_operadora'] .'&raquo;, ha sido Actualizada Exitosamente');        
        return Redirect::route('redes.edit_operadora',$id);
    }


    public function status_operadora($id)
    {        
        $operadora = Operadoras::findOrFail($id);           
        return view('especificaciones/redes.status_operadora',['operadora'=>$operadora])->with('page_title', 'Estado');
    }

    public function statusChange_operadora($id, Request $request)
    {
        $this->validate($request, [
            'bol_eliminado'         => 'required|boolean',            
        ]);             
        $operadora = Operadoras::find($id);
        $operadora->fill($request->all());
        $operadora->save();
        Session::flash('message', 'La Operadora ha cambiado de Estado');
        return Redirect::route('redes.status_operadora',$id);       
    }

    public function delete_operadora($id)
    {   
        // Consulta la tabla tbl_operadoras
        $operadora = Operadoras::findOrFail($id);
        return view('especificaciones/redes.delete_operadora',['operadora'=>$operadora])->with('page_title', 'Eliminar');
    }

    public function destroy_operadora($id)
    {
        $delete = Operadoras::destroy($id);        
        Session::flash('message', 'Operadora Eliminado Exitosamente');
        return Redirect::route('redes.operadoras');
    }
    
    public function bateria()
    {   
        return view('especificaciones/bateria.index')->with('page_title', 'Principal');
    }
    
    public function tipo_bateria()
    {   
        return view('especificaciones/bateria.tipo')->with('page_title', 'Principal');
    }

    public function create_tipo_bateria()
    {   
        return view('especificaciones/bateria.create_tipo')->with('page_title', 'Principal');
    }

    public function store_tipo_bateria()
    {   
        return view('')->with('page_title', 'Principal');
    }

    public function edit_tipo_bateria()
    {   
        return view('')->with('page_title', 'Principal');
    }

    public function update_tipo_bateria()
    {   
        return view('')->with('page_title', 'Principal');
    }

    public function show_tipo_bateria()
    {   
        return view('')->with('page_title', 'Principal');
    }

    public function status_tipo_bateria()
    {   
        return view('')->with('page_title', 'Principal');
    }

    public function statusChange_tipo_bateria()
    {   
        return view('')->with('page_title', 'Principal');
    }

    public function delete_tipo_bateria()
    {   
        return view('')->with('page_title', 'Principal');
    }

    public function destroy_tipo_bateria()
    {   
        return view('')->with('page_title', 'Principal');
    }
   
    public function cuerpo()
    {   
        return view('especificaciones/cuerpo.index')->with('page_title', 'Principal');
    }

    public function color()
    {   
        $color = DB::table('cat_datos_maestros')
       ->where('cat_datos_maestros.str_tipo', '=' , 'color')
       ->select('id','str_descripcion','str_caracteristica','bol_eliminado')
       ->orderBy('str_descripcion')
       ->get();
        
        $count = DB::table('cat_datos_maestros')->where('cat_datos_maestros.str_tipo', '=' , 'color')->count(); // Cantidad de Marcas ej: 1000 marcas        
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
                    

            }else {
                $paginado['recorrido']  = $paginado['incremento'] - $paginado['filtro'];
                $paginado['numeracion']++;
                $filtro[] = 
                    [ 
                        'numeracion' => $paginado['numeracion'],
                        'skip'       => $paginado['recorrido'],
                        'take'       => $paginado['filtro']
                    ];   
                    
            }
        }        
        // Fin Paginador       
        return view('especificaciones/cuerpo.color',['color'=>$color,'filtro'=>$filtro, 'total'=>$count])->with('page_title', 'Principal');
    }

    public function create_color()
    {
        return view('especificaciones/cuerpo.create_color')->with('page_title', 'Agregar');  
    }

   
    public function store_color(Request $request)
    {
        
        $this->validate($request, [                 
            'str_descripcion'            => 'required|unique:cat_datos_maestros',
            'str_caracteristica'=> 'required|unique:cat_datos_maestros,str_caracteristica,'
        ]);

        // Creando el Color
        $color = Maestro::create([
            'str_tipo' => 'color',
            'str_descripcion'=> ucfirst(strtolower($request['str_descripcion'])), 
            'str_caracteristica'     => $request['str_caracteristica'],           
            'bol_eliminado'=> 0
        ]);
        
        Session::flash('message', 'El Color &laquo;'. $request['str_descripcion'] .'&raquo;, ha sido Registrado Exitosamente');        
        return Redirect::route('cuerpo.create_color');
    } 

    public function edit_color($id)
    {     
        // Consulta la tabla Datos Maestros 
        $color = Maestro::findOrFail($id);
        return view('especificaciones/cuerpo.edit_color',['color'=>$color])->with('page_title', 'Editar');
    }

    public function update_color($id, Request $request)
    {
        $this->validate($request, [               
            'str_descripcion'=> 'required|unique:cat_datos_maestros,str_descripcion,'. $id,
            'str_caracteristica'=> 'required|unique:cat_datos_maestros,str_caracteristica,'. $id
        ]);  
        // Actualiza El Tipo de Sim Card
        $color = Maestro::find($id);
        if($request['str_descripcion']==""){            
            $color->fill($request->all());                
        }else {

            $color->fill([
            'str_descripcion'      => ucfirst(strtolower($request['str_descripcion'])),
            'str_caracteristica'     => $request['str_caracteristica'],
            ]);
            
        }         
        $color->save(); 
          
        Session::flash('message', 'El Color &laquo;'. $request['str_descripcion'] .'&raquo;, ha sido Actualizado Exitosamente');        
        return Redirect::route('cuerpo.edit_color',$id);
    }

    public function show_color($id)
    {
        // Consulta la tabla Datos Maestros 
        $color = Maestro::findOrFail($id);
        return view('especificaciones/cuerpo.show_color',['color'=>$color])->with('page_title', 'Consultar');
    }

    public function status_color($id)
    {        
        $color = Maestro::findOrFail($id);           
        return view('especificaciones/cuerpo.status_color',['color'=>$color])->with('page_title', 'Estado');
    }

    public function statusChange_color($id, Request $request)
    {
        $this->validate($request, [
            'bol_eliminado'         => 'required|boolean',            
        ]);             
        $color = Maestro::find($id);
        $color->fill($request->all());
        $color->save();
        Session::flash('message', 'El Color ha cambiado de Estado');
        return Redirect::route('cuerpo.status_color',$id);       
    }

    public function delete_color($id)
    {   
        // Consulta la tabla Datos Maestros 
        $color = Maestro::findOrFail($id);
        return view('especificaciones/cuerpo.delete_color',['color'=>$color])->with('page_title', 'Eliminar');
    }

    public function destroy_color($id)
    {
        $delete = Maestro::destroy($id);        
        Session::flash('message', 'Color Eliminado Exitosamente');
        return Redirect::route('cuerpo.color');
    }

    public function simcard()
    {   
       $simcard = DB::table('cat_datos_maestros')
       ->where('cat_datos_maestros.str_tipo', '=' , 'SIM CARDS')
       ->select('id','str_descripcion','str_caracteristica','bol_eliminado')
       ->orderBy('str_descripcion')
       ->get();
        
        $count = DB::table('cat_datos_maestros')->where('cat_datos_maestros.str_tipo', '=' , 'SIM CARDS')->count(); // Cantidad de Marcas ej: 1000 marcas        
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
                    

            }else {
                $paginado['recorrido']  = $paginado['incremento'] - $paginado['filtro'];
                $paginado['numeracion']++;
                $filtro[] = 
                    [ 
                        'numeracion' => $paginado['numeracion'],
                        'skip'       => $paginado['recorrido'],
                        'take'       => $paginado['filtro']
                    ];   
                    
            }
        }        
        // Fin Paginador       
        return view('especificaciones/cuerpo.simcard',['simcard'=>$simcard,'filtro'=>$filtro, 'total'=>$count])->with('page_title', 'Principal');
    }

    public function create_simcard()
    {
        return view('especificaciones/cuerpo.create_simcard')->with('page_title', 'Agregar');  
    }

   
    public function store_simcard(Request $request)
    {
        
        $this->validate($request, [                 
            'str_descripcion'            => 'required|unique:cat_datos_maestros'
        ]);

        // Creando el Sistema Operativo
        $simcard = Maestro::create([
            'str_tipo' => 'SIM CARDS',
            'str_descripcion'=> ucfirst(strtolower($request['str_descripcion'])),            
            'bol_eliminado'=> 0
        ]);
        
        Session::flash('message', 'El Tipo de Sim Card &laquo;'. $request['str_descripcion'] .'&raquo;, ha sido Registrado Exitosamente');        
        return Redirect::route('cuerpo.create_simcard');
    } 

    public function edit_simcard($id)
    {     
        // Consulta la tabla Datos Maestros 
        $simcard = Maestro::findOrFail($id);
        return view('especificaciones/cuerpo.edit_simcard',['simcard'=>$simcard])->with('page_title', 'Editar');
    }

    public function update_simcard($id, Request $request)
    {
        $this->validate($request, [               
            'str_descripcion'=> 'required|unique:cat_datos_maestros,str_descripcion,'. $id
        ]);  
        // Actualiza El Tipo de Sim Card
        $simcard = Maestro::find($id);
        if($request['str_descripcion']==""){            
            $simcard->fill($request->all());                
        }else {

            $simcard->fill([
            'str_descripcion'      => ucfirst(strtolower($request['str_descripcion']))
            ]);
            
        }         
        $simcard->save(); 
          
        Session::flash('message', 'El Tipo de Sim Card &laquo;'. $request['str_descripcion'] .'&raquo;, ha sido Actualizado Exitosamente');        
        return Redirect::route('cuerpo.edit_simcard',$id);
    }

    public function show_simcard($id)
    {
        // Consulta la tabla Datos Maestros 
        $simcard = Maestro::findOrFail($id);

        return view('especificaciones/cuerpo.show_simcard',['simcard'=>$simcard])->with('page_title', 'Consultar');
    }

    public function status_simcard($id)
    {        
        $simcard = Maestro::findOrFail($id);           
        return view('especificaciones/cuerpo.status_simcard',['simcard'=>$simcard])->with('page_title', 'Estado');
    }

    public function statusChange_simcard($id, Request $request)
    {
        $this->validate($request, [
            'bol_eliminado'         => 'required|boolean',            
        ]);             
        $simcard = Maestro::find($id);
        $simcard->fill($request->all());
        $simcard->save();
        Session::flash('message', 'El Tipo de Sim Card ha cambiado de Estado');
        return Redirect::route('cuerpo.status_simcard',$id);       
    }

    public function delete_simcard($id)
    {   
        // Consulta la tabla Datos Maestros 
        $simcard = Maestro::findOrFail($id);
        return view('especificaciones/cuerpo.delete_simcard',['simcard'=>$simcard])->with('page_title', 'Eliminar');
    }

    public function destroy_simcard($id)
    {
        $delete = Maestro::destroy($id);        
        Session::flash('message', 'Tipo de Sim Card Eliminado Exitosamente');
        return Redirect::route('cuerpo.simcard');
    }


    public function memoria()
    {   
        return view('especificaciones/memoria.index')->with('page_title', 'Principal');
    }

    public function unidmed()
    {   
        $um = DB::table('cat_datos_maestros')
       ->where('cat_datos_maestros.str_tipo', '=' , 'um')
       ->select('id','str_descripcion','str_caracteristica','bol_eliminado')
       ->orderBy('str_descripcion')
       ->get();
        
        $count = DB::table('cat_datos_maestros')->where('cat_datos_maestros.str_tipo', '=' , 'um')->count(); // Cantidad de Marcas ej: 1000 marcas        
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
                    

            }else {
                $paginado['recorrido']  = $paginado['incremento'] - $paginado['filtro'];
                $paginado['numeracion']++;
                $filtro[] = 
                    [ 
                        'numeracion' => $paginado['numeracion'],
                        'skip'       => $paginado['recorrido'],
                        'take'       => $paginado['filtro']
                    ];   
                    
            }
        }        
        // Fin Paginador       
        return view('especificaciones/bateria.unidmed',['um'=>$um,'filtro'=>$filtro, 'total'=>$count])->with('page_title', 'Principal');
    }

    public function create_unidmed()
    {   
        return view('')->with('page_title', 'Principal');
    }

    public function store_unidmed()
    {   
        return view('')->with('page_title', 'Principal');
    }

    public function edit_unidmed()
    {   
        return view('')->with('page_title', 'Principal');
    }

    public function update_unidmed()
    {   
        return view('')->with('page_title', 'Principal');
    }

    public function show_unidmed()
    {   
        return view('')->with('page_title', 'Principal');
    }

    public function status_unidmed()
    {   
        return view('')->with('page_title', 'Principal');
    }

    public function statusChange_unidmed()
    {   
        return view('')->with('page_title', 'Principal');
    }

    public function delete_unidmed()
    {   
        return view('')->with('page_title', 'Principal');
    }

    public function destroy_unidmed()
    {   
        return view('')->with('page_title', 'Principal');
    }

    public function pantalla()
    {   
        return view('especificaciones/plataforma.index')->with('page_title', 'Principal');
    }
    
    public function pantalla_tecnologia()
    {   
       $tecnologia = DB::table('cat_datos_maestros')
       ->where('cat_datos_maestros.str_tipo', '=' , 'pantalla')
       ->select('id','str_descripcion','str_caracteristica','bol_eliminado')
       ->orderBy('str_descripcion')
       ->get();
        
        $count = DB::table('cat_datos_maestros')->where('cat_datos_maestros.str_tipo', '=' , 'pantalla')->count(); // Cantidad de Marcas ej: 1000 marcas        
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
                    

            }else {
                $paginado['recorrido']  = $paginado['incremento'] - $paginado['filtro'];
                $paginado['numeracion']++;
                $filtro[] = 
                    [ 
                        'numeracion' => $paginado['numeracion'],
                        'skip'       => $paginado['recorrido'],
                        'take'       => $paginado['filtro']
                    ];   
                    
            }
        }        
        // Fin Paginador       
        return view('especificaciones/pantalla.tecnologia',['tecnologia'=>$tecnologia,'filtro'=>$filtro, 'total'=>$count])->with('page_title', 'Principal');
    }

    public function create_pantalla_tecnologia()
    {
        return view('especificaciones/pantalla.create_tecnologia')->with('page_title', 'Agregar');  
    }

   
    public function store_pantalla_tecnologia(Request $request)
    {
        
        $this->validate($request, [                 
            'str_descripcion'            => 'required|unique:cat_datos_maestros'
        ]);

        // Creando el Sistema Operativo
        $tecnologia = Maestro::create([
            'str_tipo' => 'pantalla',
            'str_descripcion'=> ucfirst(strtolower($request['str_descripcion'])),            
            'bol_eliminado'=> 0
        ]);
        
        Session::flash('message', 'El Nombre de la Tecnología &laquo;'. $request['str_descripcion'] .'&raquo;, ha sido Registrado Exitosamente');        
        return Redirect::route('pantalla.create_tecnologia');
    } 


    public function edit_pantalla_tecnologia($id)
    {     
        // Consulta la tabla Datos Maestros 
        $tecnologia = Maestro::findOrFail($id);
        return view('especificaciones/pantalla.edit_tecnologia',['tecnologia'=>$tecnologia])->with('page_title', 'Editar');
    }

    public function update_pantalla_tecnologia($id, Request $request)
    {
        $this->validate($request, [               
            'str_descripcion'=> 'required|unique:cat_datos_maestros,str_descripcion,'. $id
        ]);  
        // Actualiza los Datos de un Sistema Operativo
        $tecnologia = Maestro::find($id);
        if($request['str_descripcion']==""){            
            $tecnologia->fill($request->all());                
        }else {

            $tecnologia->fill([
            'str_descripcion'      => ucfirst(strtolower($request['str_descripcion']))
            ]);
            
        }         
        $tecnologia->save(); 
          
        Session::flash('message', 'El Nombre de la Tecnología &laquo;'. $request['str_descripcion'] .'&raquo;, ha sido Actualizado Exitosamente');        
        return Redirect::route('pantalla.edit_tecnologia',$id);
    }

    public function show_pantalla_tecnologia($id)
    {
        // Consulta la tabla Marcas 
        $tecnologia = Maestro::findOrFail($id);

        return view('especificaciones/pantalla.show_tecnologia',['tecnologia'=>$tecnologia])->with('page_title', 'Consultar');
    }

     public function status_pantalla_tecnologia($id)
    {        
        $tecnologia = Maestro::findOrFail($id);           
        return view('especificaciones/pantalla.status_tecnologia',['tecnologia'=>$tecnologia])->with('page_title', 'Estado');
    }

    public function statusChange_pantalla_tecnologia($id, Request $request)
    {
        $this->validate($request, [
            'bol_eliminado'         => 'required|boolean',            
        ]);             
        $tecnologia = Maestro::find($id);
        $tecnologia->fill($request->all());
        $tecnologia->save();
        Session::flash('message', 'El Nombre de la Tecnología ha cambiado de Estado');
        return Redirect::route('pantalla.status_tecnologia',$id);       
    }

    public function delete_pantalla_tecnologia($id)
    {   
        // Consulta la tabla Datos Maestros 
        $tecnologia = Maestro::findOrFail($id);
        return view('especificaciones/pantalla.delete_tecnologia',['tecnologia'=>$tecnologia])->with('page_title', 'Eliminar');
    }

    public function destroy_pantalla_tecnologia($id)
    {
        $delete = Maestro::destroy($id);        
        Session::flash('message', 'La Tecnología Eliminado Exitosamente');
        return Redirect::route('pantalla.tecnologia');
    }




    public function plataforma()
    {   
        return view('especificaciones/plataforma.index')->with('page_title', 'Principal');
    }
    
    public function so()
    {
        $so = DB::table('cat_datos_maestros')
       ->where('cat_datos_maestros.str_tipo', '=' , 'SO')
       ->select('id','str_descripcion','str_caracteristica','bol_eliminado')
       ->orderBy('str_descripcion')
       ->get();
        
        $count = DB::table('cat_datos_maestros')->where('cat_datos_maestros.str_tipo', '=' , 'SO')->count(); // Cantidad de Marcas ej: 1000 marcas        
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
                    

            }else {
                $paginado['recorrido']  = $paginado['incremento'] - $paginado['filtro'];
                $paginado['numeracion']++;
                $filtro[] = 
                    [ 
                        'numeracion' => $paginado['numeracion'],
                        'skip'       => $paginado['recorrido'],
                        'take'       => $paginado['filtro']
                    ];   
                    
            }
        }        
        // Fin Paginador       
        return view('especificaciones/plataforma.so',['so'=>$so,'filtro'=>$filtro, 'total'=>$count])->with('page_title', 'Principal');
    }

    
    public function create_so()
    {
        return view('especificaciones/plataforma.create_so')->with('page_title', 'Agregar');  
    }

   
    public function store_so(Request $request)
    {
        
        $this->validate($request, [                 
            'str_descripcion'            => 'required|unique:cat_datos_maestros'
        ]);

        // Creando el Sistema Operativo
        $so = Maestro::create([
            'str_tipo' => 'SO',
            'str_descripcion'=> ucfirst(strtolower($request['str_descripcion'])),            
            'bol_eliminado'=> 0
        ]);
        
        Session::flash('message', 'El Sistema Operativo &laquo;'. $request['str_descripcion'] .'&raquo;, ha sido Registrado Exitosamente');        
        return Redirect::route('plataforma.create_so');
    } 


    public function edit_so($id)
    {     
        // Consulta la tabla Datos Maestros 
        $so = Maestro::findOrFail($id);
        return view('especificaciones/plataforma.edit_so',['so'=>$so])->with('page_title', 'Editar');
    }

    public function update_so($id, Request $request)
    {
        $this->validate($request, [               
            'str_descripcion'=> 'required|unique:cat_datos_maestros,str_descripcion,'. $id
        ]);  
        // Actualiza los Datos de un Sistema Operativo
        $so = Maestro::find($id);
        if($request['str_descripcion']==""){            
            $so->fill($request->all());                
        }else {

            $so->fill([
            'str_descripcion'      => ucfirst(strtolower($request['str_descripcion']))
            ]);
            
        }         
        $so->save(); 
          
        Session::flash('message', 'El Sistema Operativo &laquo;'. $request['str_descripcion'] .'&raquo;, ha sido Actualizado Exitosamente');        
        return Redirect::route('plataforma.edit_so',$id);
    }

    public function show_so($id)
    {
        // Consulta la tabla Marcas 
        $so = Maestro::findOrFail($id);

        return view('especificaciones/plataforma.show_so',['so'=>$so])->with('page_title', 'Consultar');
    }

    public function status_so($id)
    {        
        $so = Maestro::findOrFail($id);           
        return view('especificaciones/plataforma.status_so',['so'=>$so])->with('page_title', 'Estado');
    }

    public function statusChange_so($id, Request $request)
    {
        $this->validate($request, [
            'bol_eliminado'         => 'required|boolean',            
        ]);             
        $so = Maestro::find($id);
        $so->fill($request->all());
        $so->save();
        Session::flash('message', 'El Sistema Operativo ha cambiado de Estado');
        return Redirect::route('plataforma.status_so',$id);       
    }

    public function delete_so($id)
    {   
        // Consulta la tabla Datos Maestros 
        $so = Maestro::findOrFail($id);
        return view('especificaciones/plataforma.delete_so',['so'=>$so])->with('page_title', 'Eliminar');
    }

    public function destroy_so($id)
    {
        $delete = Maestro::destroy($id);        
        Session::flash('message', 'Sistema Operativo Eliminado Exitosamente');
        return Redirect::route('plataforma.so');
    }
}

?>
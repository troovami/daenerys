<?php

namespace Troovami\Http\Controllers;

use Illuminate\Http\Request;

use Troovami\Http\Requests;
use Troovami\Http\Controllers\Controller;
use Troovami\Vehiculo;
use Troovami\DetalleVehiculo;
use Troovami\ImagenesVehiculos;
use Session;
use Redirect;
use DB;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $vehiculos= DB::table('tbl_vehiculos')
        ->join('cat_datos_maestros as vehiculos', 'tbl_vehiculos.lng_idtipo_vehiculo', '=', 'vehiculos.id') // TIPO VEHICULO
        ->join('cat_paises as paises', 'tbl_vehiculos.lng_idpais', '=', 'paises.id') // PAIS
        ->select(
            'vehiculos.str_descripcion as tipo_vehiculo',  // TIPO VEHICULO
            'paises.str_paises as pais',  // PAIS
            'paises.blb_img as blb_img',  // IMAGEN PAIS            
            'tbl_vehiculos.id',
            'tbl_vehiculos.str_placa',
            'tbl_vehiculos.bol_eliminado'
            )
        ->get(); 
        foreach ($vehiculos as $key => $value) {                    
            // Detectando el Tipo de Formato del la Imagen              
            $a = base64_decode($value->blb_img);
            $b = finfo_open();            
            //Agregando un nuevo atributo al array
            $value->format = finfo_buffer($b, $a, FILEINFO_MIME_TYPE); 
            $value->str_placa = strtoupper($value->str_placa);           
        } 
        //return $vehiculos;
        
        
        return view('vehiculo.vehiculo',compact('vehiculos'))->with('page_title', 'Principal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

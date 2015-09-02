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
    public function publicacionesActivas()
    {
        $vehiculos= DB::table('tbl_vehiculos as publicaciones')
        ->join('cat_datos_maestros as vehiculos', 'publicaciones.lng_idtipo_vehiculo', '=', 'vehiculos.id') // TIPO VEHICULO
        ->join('cat_paises as paises', 'publicaciones.lng_idpais', '=', 'paises.id') // PAIS
        ->join('tbl_personas as personas', 'publicaciones.lng_idpersona', '=', 'personas.id') // Persona
        ->join('tbl_modelos as modelos', 'publicaciones.lng_idmodelo', '=', 'modelos.id') // PAIS
        ->join('cat_marcas as marcas', 'modelos.lng_idmarca', '=', 'marcas.id') // PAIS
        ->select(
            'vehiculos.str_descripcion as clasificacion',  // Clasificacion
            'vehiculos.str_tipo as vehiculo',  // Vehiculo
            'paises.str_paises as pais',  // PAIS
            'personas.name',  // name
            //'paises.blb_img as blb_img', // IMAGEN PAIS            
            'publicaciones.id',
            'modelos.str_modelo',            
            'marcas.str_marca', 
            'publicaciones.bol_eliminado'
            )
        ->get();         
        
        
        return view('vehiculo.publicaciones-activas',compact('vehiculos'))->with('page_title', 'Principal');
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

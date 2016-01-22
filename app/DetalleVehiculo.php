<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class DetalleVehiculo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_detalles_vehiculos';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['lng_idvehiculo','lng_idcaracteristica','bol_eliminado','updated_at','created_at'];
}

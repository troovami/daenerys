<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class ImagenesVehiculos extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_imagenes_vehiculos';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['lng_idvehiculo','blb_img','int_peso','bol_eliminado','updated_at','created_at'];
}

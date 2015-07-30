<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_vehiculos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected protected $fillable = ['lng_idpersona','lng_idtipo_vehiculo','str_placa','lng_idmodelo','str_motor','int_cilindros',
      'int_ano','lng_idequipo_medico','int_pisos','str_carroceria','lng_idfrenado','int_carga','int_lastre','lng_idmotor',
      'dbl_neumatico','dbl_potenciamax','int_pasajeros','int_horasuso','str_comentario','lng_idnegociable','lng_idtraccion',
      'lng_idtapizado','lng_idmotorreparado','lng_idvidrios','int_cantidad_puertas','lng_idcolor','lng_idcombustible',
      'lng_idunicodueno','str_recorrido','str_version','lng_idtipomotor','lng_idfinanciamiento','lng_idchocado',
      'lng_idrecibomoto','lng_idsistemaarranque','dmt_fecha_publicacion_fin','dmt_fecha_publicacion','bol_eliminado',
      'int_esloralargo','int_mangaancho','lng_idmaxtripulantes','lng_idmaterial','int_peso','int_potenciamax',
      'str_precio_venta', 'lng_idpais','str_video','str_moneda','lng_idestereo','lng_iddireccion','lng_idtransmision'];
}

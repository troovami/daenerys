<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_modelos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'id',
                            'str_modelo',
                            'blb_img_normal',
                            'blb_img_mini',
                            'blb_img360',
                            'lng_idadmin',
                            'lng_idmarca',
                            'lng_idtipo_equipo',
                            'lng_idclasificacion',
                            'lng_idgama',
                            'str_friendly_url',
                            'str_title',
                            'str_meta_descripcion',
                            'str_meta_keyword',
                            'bol_eliminado'
                          ];
}

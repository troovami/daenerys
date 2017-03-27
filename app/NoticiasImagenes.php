<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class NoticiasImagenes extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_imagenes_noticias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'id',
                            'lng_idnoticias',
                            'blb_img',
                            'int_peso',
                            'bol_eliminado'
                          ];

}

<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Noticia extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_noticias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'id',
                            'str_titulo',
                            'str_contenido',
                            'lng_idtipo',
                            'str_friendly_url',
                            'str_meta_descripcion',
                            'str_meta_keyword',
                            'lng_idempresa',
                            'lng_idadmin',
                            'bol_eliminado'
                          ];

}

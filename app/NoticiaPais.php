<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class NoticiaPais extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_noticias_paises';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'id',
                            'lng_idnoticia',
                            'lng_idpais',
                            'bol_eliminado'
                          ];

}

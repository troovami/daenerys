<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class TipoMarca extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_tipos_marcas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'lng_idtipo',
                            'lng_idmarca',  
                            'str_meta_descripcion',
                            'str_meta_keyword',                                                      
                            'bol_eliminado'
                          ];
}

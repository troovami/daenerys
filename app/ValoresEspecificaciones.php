<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class ValoresEspecificaciones extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cat_valores_especificaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'id',
                            'lng_idespecificacion', 
                            'str_titulo',
                            'str_descripcion',
                            'int_comparacion',
                            'int_valor',
                            'bol_eliminado'
                          ];
}

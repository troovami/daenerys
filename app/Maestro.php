<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cat_datos_maestros';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'str_tipo', 
                            'str_descripcion', 
                            'str_caracteristica', 
                            'str_caracteristica2', 
                            'str_caracteristica3', 
                            'int_peso', 
                            'bol_eliminado'                            
                          ];
}

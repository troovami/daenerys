<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class TecnologiaFrecuencia extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cat_tecnologias_frecuencias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'id',
                            'lng_idtecnologia',
                            'lng_idfrecuencia',
                            'bol_eliminado'                            
                          ];
}

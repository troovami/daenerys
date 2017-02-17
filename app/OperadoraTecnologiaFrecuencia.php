<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class OperadoraTecnologiaFrecuencia extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_frecuencias_tecnos_operadoras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'id',
                            'lng_idoperadora',
                            'lng_idfrecuencia_tecnologia',
                            'bol_eliminado'                            
                          ];
}

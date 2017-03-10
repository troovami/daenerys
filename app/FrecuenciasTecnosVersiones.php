<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class FrecuenciasTecnosVersiones extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_frecuencias_tecnos_versiones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'id',
                            'lng_idversion_modelo',
                            'lng_frec_tecno_oper',
                            'bol_eliminado'
                          
                          ];
}

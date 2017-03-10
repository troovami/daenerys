<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class VersionesValoresEspecificaciones extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_versiones_valores_especificaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'id',
                            'lng_idversion_modelo',
                            'lng_idvalores_especificaciones',
                            'bol_eliminado'
                          ];
}


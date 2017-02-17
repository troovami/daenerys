<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_versiones_modelos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'id',
                            'lng_idmodelo',
                            'lng_idadmin',
                            'str_version',
                            'int_cantidad',
                            'bol_eliminado'
                          ];
}

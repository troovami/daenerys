<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class OperadoraPais extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_operadora_pais';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                           'id',
                           'lng_idoperadora',
                           'lng_idpais'
                          ];
}

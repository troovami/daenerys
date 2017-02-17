<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class Operadoras extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_operadoras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'id',
                            'str_operadora',
                            'blb_img',
                            'bol_eliminado'
                          ];
}

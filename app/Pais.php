<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cat_paises';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'str_paises',
                            'str_abreviatura',
                            'blb_img',
                            'bol_eliminado'
                          ];

}

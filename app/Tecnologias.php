<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class Tecnologias extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cat_tecnologias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'id',
                            'lng_idgeneracion',
                            'str_especificaciones',
                            'str_description',
                            'bol_eliminado'                            
                          ];
}

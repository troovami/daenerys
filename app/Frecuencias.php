<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class Frecuencias extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cat_frecuencias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'id',
                            'str_frecuecia', 
                            'bol_eliminado'                            
                          ];
}

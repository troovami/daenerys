<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cat_marcas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'str_marca',
                            'str_friendly_url',
                            'str_meta_descripcion',
                            'str_meta_keyword',
                            'str_website',
                            'lng_idtipo',
                            'bol_eliminado',
                            'blb_img'                            
                          ];
}

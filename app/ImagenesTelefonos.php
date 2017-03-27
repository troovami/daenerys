<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class ImagenesTelefonos extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_imagenes_modelos';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'lng_idversion',
                            'blb_img',
                            'str_alt',
                            'bol_eliminado',
                            'updated_at',
                            'created_at'
                            ];
}


<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_personas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'name',
                            'str_nombre',
                            'str_apellido',
                            'lng_idgenero',
                            'dmt_fecha_nacimiento',
                            'str_ididentificacion',
                            'str_pasaporte',
                            'lng_idpais',
                            'password',
                            'email',
                            'str_telefono',
                            //'lng_idrol',
                            //'str_twitter',
                            //'str_facebook',
                            //'str_instagram',
                            'bol_certificado',
                            'bol_eliminado',
                            'lng_idservicio'//,
                            //'blb_img'
                          ];
	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
}

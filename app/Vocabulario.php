<?php

namespace Troovami;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Vocabulario extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_vocabularios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'id',
                            'str_vocabulario',
                            'str_friendly_url',
                            'bol_eliminado',
                            'updated_at',
                            'created_at',
                          ];





}

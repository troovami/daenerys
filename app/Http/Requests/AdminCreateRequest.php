<?php

namespace Troovami\Http\Requests;

use Troovami\Http\Requests\Request;

class AdminCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'required|max:255|unique:tbl_admins',
            'str_cedula'   => 'required|max:255|unique:tbl_admins',   
            'str_nombre'   => 'required|max:255',
            'str_apellido' => 'required|max:255',
            'password'     => 'required|confirmed|min:6',
            'email'        => 'required|email|max:255|unique:tbl_admins',
            'str_telefono' => 'required|max:255',
            'lng_idrol'    => 'required|max:255',
        ];
    }
}

<?php

namespace shcart\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            //
            'nombres' => 'required',
            'apellidos' => 'required',
            'email' => 'required|email',
            'direccion' => 'required',
            'codigo_postal' => 'required',
            'telefono' => 'required',
            'movil' => 'required',

            'numerotarjeta' => 'required',
            'mesexpiracion' => 'required',
            'añoexpiracion' => 'required',
            'tarjetacvc' => 'required'
        ];
    }
}
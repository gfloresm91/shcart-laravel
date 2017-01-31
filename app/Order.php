<?php

namespace shcart;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'user_id','carro','nombres','apellidos','email','direccion','codigo_postal','telefono','movil','comentario','id_pago'
    ];

    public function user()
    {
        return $this->belongsTo('shcart\User');
    }
}

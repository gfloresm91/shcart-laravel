<?php

namespace shcart;

use Illuminate\Database\Eloquent\Model;

//Librerias
use Auth;
use Stripe\Charge;
use Swap;

class Order extends Model
{
    //
    protected $fillable = [
        'user_id',
        'carro',
        'nombres',
        'apellidos',
        'email',
        'direccion',
        'codigo_postal',
        'telefono',
        'movil',
        'comentario',
        'id_pago'
    ];

    public function user()
    {
        return $this->belongsTo('shcart\User');
    }

    //Crea una orden
    public static function crear($cart, $request)
    {
        $rate = Swap::latest('USD/CLP');
        $charge = Charge::create(array(
            "amount" => (number_format(($cart->totalPrecio / $rate->getValue()),2) * 100),
            "currency" => "usd",
            "description" => "Example charge",
            "source" => $request->input('stripeToken'),
            ));

        $order = Order::create([
                        'user_id' => Auth::user()->id,
                        'carro' => serialize($cart),
                        'nombres' => $request->input('nombres'),
                        'apellidos' => $request->input('apellidos'),
                        'email' => $request->input('email'),
                        'direccion' => $request->input('direccion'),
                        'codigo_postal' => $request->input('codigo_postal'),
                        'telefono' => $request->input('telefono'),
                        'movil' => $request->input('movil'),
                        'comentario' => $request->input('comentario'),
                        'id_pago' => $charge->id
                     ]);
        Auth::user()->orders()->save($order);

        return $order;
    }
}

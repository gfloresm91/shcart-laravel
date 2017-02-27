<?php

namespace shcart;

use Illuminate\Database\Eloquent\Model;

//Librerias
use Auth;
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
        $user = Auth::user();
        $rate = Swap::latest('USD/CLP');
        $totalusd = (number_format(($cart->totalPrecio / $rate->getValue()),2) * 100);
        
        $charge = $user->charge($totalusd,[
                        "description" => "Pago usuario ".Auth::user()->nombre. " ID #".Auth::user()->id,
                        "source" => $request->input('stripeToken')
                    ]);

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

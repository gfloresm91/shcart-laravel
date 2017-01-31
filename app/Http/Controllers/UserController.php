<?php

namespace shcart\Http\Controllers;

use Illuminate\Http\Request;

//Librerias
use Redirect;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

//Requests
use shcart\Http\Requests\UserRequest;

//Models
use shcart\User;
use shcart\Cart;

class UserController extends Controller
{
    //
    public function login()
    {
        return view('user.login');
    }

    public function postlogin(UserRequest $request)
    {
        //Boton login
        if(Input::get('buttonlogin') === "login")
        {
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            {
                return Redirect::route('user.login');
            }
            else
            {
                return Redirect::route('user.login')
                        ->with('mensaje', 'Lo sentimos pero el usuario o contraseña es incorrecta');
            }

        }

        //Boton registrar
        $nuevousuario = User::create($request->all());
        $nuevousuario->password = Hash::make($request->password);
        $nuevousuario->save();
        return Redirect::route('user.login');

    }
     
    public function perfil()
    {
        $orders = Auth::user()->orders;
        $orders->transform(function ($order, $key){
            $order->carro = unserialize($order->carro);
            return $order;
        });
       
        return view('user.perfil', ['orders' => $orders]);
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::route('product.index');
    }
}

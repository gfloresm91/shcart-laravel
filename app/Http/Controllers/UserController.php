<?php

namespace shcart\Http\Controllers;

use Illuminate\Http\Request;

//Librerias
use Redirect;
use Validator;
use Session;
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
    //Page: Iniciar sesion y registrar usuario
    //route: user.login
    //params:
    //Models: 
    //return: views/user/login
    public function login()
    {
        return view('user.login');
    }

    //Page: POST Iniciar sesion y registrar usuario
    //route: user.postlogin
    //params: Session->oldUrl, $request->Validacion app/UserRequest
    //Models: shcart/User
    //return: $notificacion ->views/user/login
    public function postlogin(UserRequest $request)
    {
        //Boton login
        if(Input::get('buttonlogin') === "login")
        {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            {
                if(Session::has('oldUrl'))
                {
                    $oldUrl = Session::get('oldUrl');
                    Session::forget('oldUrl');
                    return Redirect::to($oldUrl);
                }
                return Redirect::route('user.login');
            }
            else
            {
                $notificacion = array(
                    'message' => 'Usuario o contraseña incorrectos', 
                    'alert-type' => 'error'
                );

                return Redirect::route('user.login')
                                ->with($notificacion);
            }

        }

        //Boton registrar
        $nuevousuario = User::create($request->all());
        $nuevousuario->password = Hash::make($request->password);
        $nuevousuario->save();

        $notificacion = array(
                    'message' => 'Usuario registrado correctamente, inicie sesion', 
                    'alert-type' => 'success'
                );

        if(Session::has('oldUrl'))
        {
            $oldUrl = Session::get('oldUrl');
            Session::forget('oldUrl');
            return Redirect::to($oldUrl)->with($notificacion);
        }
        return Redirect::back()->with($notificacion);

    }
     
    //Page: Perfil de usuario
    //route: user.perfil
    //params: 
    //Models: shcart/User
    //return: $orders ->views/user/perfil
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

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
use Socialite;
use Log;

//Requests
use shcart\Http\Requests\UserRequest;

//Models
use shcart\User;
use shcart\Cart;
use shcart\SocialProvider;

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
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember_me))
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

    /**
    * Redirect the user to the GitHub authentication page.
    *
    * @return Response
    */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {        
        try
        {
            $socialuser = Socialite::driver($provider)->user();

            $socialprovider = SocialProvider::where('provider_id',$socialuser->getId())->first();

            if(!$socialprovider)
            {
                $user = User::firstOrCreate([
                        'email' => $socialuser->getEmail(),
                        'name' => $socialuser->getName(),
                        'nickname' => $socialuser->getNickname(),
                        'avatar' => $socialuser->getAvatar()

                    ]);

                $user->socialproviders()->create(
                    ['provider_id' => $socialuser->getId(), 'provider' => $provider]
                );

            }
            else
            {
                $user = $socialprovider->user;
            }

            Auth::login($user);

            return Redirect::route('product.index');
        }
        catch(\Exception $e)
        {
             Log::error($e->getMessage());
             $notificacion = array(
                    'message' => 'Se ha encontrado un problema con codigo #'.$e->getCode(), 
                    'alert-type' => 'error'
                );
            return Redirect::route('product.index')->with($notificacion);
        }
    }
}

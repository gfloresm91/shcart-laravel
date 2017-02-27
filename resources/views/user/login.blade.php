@extends('layouts.master')

@section('title','Login')

@section('content')
<section id="form">{{--form--}}
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                @include('partials.notificaciones')
            </div>
        </div>
        <div class="row">
            
            <div class="col-sm-5 col-sm-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">Utilice estos datos para iniciar sesion</div>
                    <div class="panel-body">
                        <p><strong>Email:</strong> test@test.com</p>
                        <p><strong>Password:</strong> test</p>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">{{--login--}}
                    <h2>Ingresa con tu cuenta</h2>
                    {!! Form::open(['route' => 'user.postlogin', 'method' => 'POST']) !!}
                        <input type="email" placeholder="Email" name="email" />
                        <input type="password" placeholder="Password" name="password" />
                        <span>
                            <input type="checkbox" class="checkbox" name="remember_me" value="true"> 
                            Mantenerme conectado
                        </span>
                        <button type="submit" class="btn btn-default" name="buttonlogin" value="login">Login</button>
                    {!! Form::close() !!}
                </div>{{--./login--}}
            </div>
            <div class="col-sm-1">
                <h2 class="or">O</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">{{--Registrar--}}
                    <h2>¡Registrate en nuestra web!</h2>
                    {!! Form::open(['route' => 'user.postlogin', 'method' => 'POST']) !!}
                        <input type="text" placeholder="Nombre" name="name"/>
                        <input type="email" placeholder="Email" name="email"/>
                        {{ Form::password('password', ['placeholder' => 'Password']) }}
                        <button type="submit" class="btn btn-default" name="buttonlogin" value="registrar">Registrar</button>
                    {!! Form::close() !!}
                </div>{{--./Registrar--}}
            </div>
        </div>
        <div class="row">
                <div class="col-sm-12 col-sm-offset-1">
                    <div class="login-form">
                    <h2>Tambien puedes acceder con tu red social preferida</h2>
                        <div class="col-sm-3">
                            <a href="{{route('user.sociallogin',['provider' => 'google'])}}" class="btn btn-block btn-social btn-google">
                                <span class="fa fa-google"></span>
                                Google
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{route('user.sociallogin',['provider' => 'facebook'])}}" class="btn btn-block btn-social btn-facebook">
                                <span class="fa fa-facebook"></span>
                                Facebook
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{route('user.sociallogin',['provider' => 'twitter'])}}" class="btn btn-block btn-social btn-twitter">
                                <span class="fa fa-twitter"></span>
                                Twitter
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>{{--./form--}}
@endsection
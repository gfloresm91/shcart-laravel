@extends('layouts.master')

@section('title','Login')

@section('content')
<section id="form">{{--form--}}
    <div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            @if(session('mensaje')){{--Usuario o contraseña incorrecta--}}
                <div class="alert alert-danger">
                    <p>{{ session('mensaje') }}</p>
                </div>
            @endif{{--./Usuario o contraseña incorrecta--}}
            @if(count($errors) > 0){{--Mensaje error--}}
                <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
                </div>
            @endif{{--./Mensaje error--}}
        </div>
    </div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
               
                <div class="login-form">{{--login--}}
                    <h2>Ingresa con tu cuenta</h2>
                    {!! Form::open(['route' => 'user.postlogin', 'method' => 'POST']) !!}
                        <input type="email" placeholder="Email" name="email" />
                        <input type="password" placeholder="Password" name="password" />
                        <span>
                            <input type="checkbox" class="checkbox"> 
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
    </div>
</section>{{--./form--}}
@endsection
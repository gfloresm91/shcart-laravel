<div class="row">
    <div class="col-sm-12">
        @if(Session::has('mensajesuccess'))
            <div class="alert alert-success">
                {{Session::get('mensajesuccess')}}
            </div>
        @endif
    </div>
</div>

@if(session('mensaje')){{--Usuario o contraseña incorrecta--}}
    <div class="alert alert-danger">
        <p>{{ session('mensaje') }}</p>
    </div>
@endif{{--./Usuario o contraseña incorrecta--}}

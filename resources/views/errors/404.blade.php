@extends('layouts.errors')

@section('title','Login')

@section('content')
    <div class="container text-center">
		<div class="content-404">
			<h1><b>UPS!</b> Pagina no encontrada</h1>
            <div class="col-sm-12">
                <img src="images/404/404.png" class="img-responsive" alt="" />
            </div>
            <h2><a href="{{route('product.index')}}">Volver al inicio</a></h2>
		</div>
	</div>
@endsection
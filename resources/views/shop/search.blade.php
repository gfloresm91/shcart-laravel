@extends('layouts.master')
@section('title', 'Busqueda')

@section('content')

<section>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-9">
            @forelse ($productos as $producto)
                <div class="media">
                    <div class="media-left media-middle">
                        @foreach($producto->imagenes->take(1) as $imagen)
                            <img class="media-object" src="{{$imagen->rutaimagen}}" alt="..." style="width:100px;height:100px;">
                        @endforeach
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{$producto->titulo}}</h4>
                        <p>{{$producto->descripcion}}</p>
                        <p>
                            <a href="{{route('product.productodetalle',['id' => $producto->id])}}" class="btn btn-info">
                                Ver detalle
                            </a>
                        </p>
                    </div>
                </div>
            @empty
                No existe 
            @endforelse

            <div style="margin-top:20px" >
                <ul class="pagination">
                    {{$productos->links()}}
                </ul>
            </div>
            
        </div>
    </div>
</div>
    
</section>
    
    

@endsection
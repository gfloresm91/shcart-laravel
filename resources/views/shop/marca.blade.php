@extends('layouts.master')

@section('title',$title->nombre)

@section('content')
<section>
    <div class="container">
        <div class="row">
            @include('partials.leftsidebar')
            
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">{{$title->nombre}}</h2>
                    @foreach($products->chunk(3) as $productos)
                        @foreach($productos as $item)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{$item->rutaimagen}}" alt="" />
                                                <h2>$ {{$item->precio}}</h2>
                                                <p>{{$item->titulo}}</p>
                                                <a href="{{route('product.anadiralcarro',['id' => $item->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Añadir al carro</a>
                                            </div>
                                            <div class="product-overlay">
                                                <div class="overlay-content">
                                                    <h2>$ {{$item->precio}}</h2>
                                                    <p>{{$item->descripcion}}</p>
                                                    <a href="{{route('product.anadiralcarro',['id' => $item->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Añadir al carro</a>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Añadir a favoritos</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Comparar</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                    
                    <ul class="pagination">
                        {{ $products->links() }}
                    </ul>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>
@endsection
@extends('layouts.master')

@section('title','Inicio')

@section('slider')
<section id="slider">{{-- Slider --}}
		<div class="container">
        @include('partials.notificaciones')
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
                            @forelse($ofertas as $oferta)
                                    <div class="item {{ $loop->first ? 'active' : ''}}">
                                        <div class="col-sm-6">
                                            <h1><span>Oferta</span> E-SHOPPER</h1>
                                            <h2>{{$oferta->titulo}}</h2>
                                            <p>{{str_limit($oferta->descripcion,100)}} </p>
                                            <a href="{{route('product.productodetalle',['id' => $oferta->id])}}" class="btn btn-default get">Ver detalle</a>
                                        </div>
                                        <div class="col-sm-6">
                                            <img src="images/home/girl1.jpg" class="girl img-responsive" alt="" />
                                            <img src="images/home/pricing.png"  class="pricing" alt="" />
                                        </div>
                                    </div>
                                @empty
                                No hay elementos
                            @endforelse	
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
</section>{{-- ./Slider --}}
@endsection

@section('content')
<section>
	<div class="container">
    @if(Session::has('success'))
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <div id="charge-message" class="alert alert-success">
                {{Session::get('success')}}
            </div>
        </div>
    </div>
    @endif

        <div class="row">
            @include('partials.leftsidebar')
            <div class="col-sm-9 padding-right">
                <div class="features_items">{{-- Ultimos productos --}}
                    <h2 class="title text-center">Productos Nuevos</h2>
                    @include('partials.productos')
                    
                </div>{{-- ./Ultimos productos --}}
                
                <div class="category-tab">{{--Pestañas Categorias--}}
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
                                @foreach($categorias->reverse()->take(4) as $categoria)
                                <li class="{{$loop->first ? 'active':''}}"><a href="#{{str_slug($categoria->nombre, '-')}}" data-toggle="tab">{{$categoria->nombre}}</a></li>
                                @endforeach                             
							</ul>
						</div>
						<div class="tab-content">
                            @foreach($categorias->reverse()->take(4) as $categoria)
                            <div class="tab-pane fade {{$loop->first ? 'active in': ''}}" id="{{str_slug($categoria->nombre, '-')}}" >
								@foreach($categoria->marcas->take(4) as $marcas)
                                    <div class="col-sm-12"><h3>{{$marcas->nombre}}</h3></div>
                                    @foreach($marcas->productos->take(4) as $producto)
                                        <div class="col-sm-3">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        @foreach($producto->imagenes->take(1) as $imagen)
                                                            <img src="{{$imagen->rutaimagen}}" alt="" />
                                                        @endforeach
                                                        <h2>${{$producto->precio}}</h2>
                                                        <p>{{$producto->titulo}}</p>
                                                        <a href="{{route('product.anadiralcarro',['id' => $producto->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-plus"></i>Añadir Carro</a>
                                                    </div>   
                                                </div>
                                                <div class="choose">
                                                    <a href="{{route('product.productodetalle',['id' => $producto->id])}}" class="btn btn-info btn-block">Ver detalle</a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    @endforeach
                                @endforeach
							</div>
                            @endforeach
							
						
							
						</div>
				</div>{{--./Pestañas Categorias--}}
                
                {{--
                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">recommended items</h2>
                    
                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">	
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend1.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend2.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend3.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">	
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend1.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend2.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend3.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                            </a>			
                    </div>
                </div><!--/recommended_items-->
                --}}
                
            </div>
        </div>

    </div>
</section>

@endsection
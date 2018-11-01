@foreach($products->chunk(3) as $productos)
    @foreach($productos as $producto)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center">
                            @foreach($producto->imagenes->take(1) as $imagen)
                                <img src="{{$imagen->rutaimagen}}" alt="" />
                            @endforeach
                            <h2>$ {{$producto->precio}}</h2>
                            <p>{{$producto->titulo}}</p>
                            <a href="{{route('product.anadiralcarro',['id' => $producto->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Añadir al carro</a>
                        </div>
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h2>$ {{$producto->precio}}</h2>
                                <p>{{$producto->descripcion}}</p>
                                <a href="{{route('product.anadiralcarro',['id' => $producto->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Añadir al carro</a>
                            </div>
                            @if($producto->condicion)
                                @if($producto->condicion == 'Nuevo')
                                    <span class="label label-success pull-right">{{$producto->condicion}}</span>
                                @endif
                            @endif
                            
                            @if($producto->oferta)
                                <span class="label label-info pull-right">En oferta</span>
                            @endif
                            
                        </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Favoritos</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Comparar</a></li>
                    </ul>
                </div>
                <div class="choose">
                    <a href="{{route('product.productodetalle',['id' => $producto->id])}}" class="btn btn-primary btn-block">Ver detalle</a>
                </div>
            </div>
        </div>
    @endforeach
@endforeach
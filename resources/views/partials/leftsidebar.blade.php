<div class="col-sm-3">{{--Panel izquierdo--}}
                <div class="left-sidebar">
                    <h2>Categorias</h2>
                    <div class="panel-group category-products" id="accordian">{{--Categorias--}}
                        @forelse ($categorias as $categoria)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        @if($categoria->marcas->count() >0)
                                            <a data-toggle="collapse" data-parent="#accordian" href="#{{camel_case($categoria->nombre)}}">
                                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                {{$categoria->nombre}}
                                            </a>
                                        @else
                                            <a href="#{{camel_case($categoria->nombre)}}">
                                                {{$categoria->nombre}}
                                            </a>
                                        @endif    
                                    </h4>
                                </div>
                                <div id="{{camel_case($categoria->nombre)}}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                        @forelse($categoria->marcas as $subcategoria)
                                            <li><a href="{{route('product.marca',['id' => $subcategoria->id])}}">{{$subcategoria->nombre}}</a></li>
                                        @empty
                                        No hay subcategoria
                                        @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @empty
                            No existen categorias
                        @endforelse
                    </div>{{--./Categorias--}}
                
                    <div class="brands_products">{{--Marcas--}}
                        <h2>Marcas</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                @forelse ($marcas as $marca)
                                    <li><a href="{{route('product.marca',['id' => $marca->id])}}"> <span class="pull-right">({{$marca->productos->count()}})</span>{{$marca->nombre}}</a></li>
                                @empty
                                    No existen Marcas
                                @endforelse
                            </ul>
                        </div>
                    </div>{{--./Marcas--}}

                </div>
            </div>{{--./Panel izquierdo--}}
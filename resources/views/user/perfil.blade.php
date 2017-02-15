@extends('layouts.master')
@section('title','Perfil')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card hovercard">
                <div class="card-background">
                    <img class="card-bkimg" alt="" src="http://lorempixel.com/100/100/people/9/">
                    <!-- http://lorempixel.com/850/280/people/9/ -->
                </div>
                <div class="useravatar">
                    <img alt="" src="http://lorempixel.com/100/100/people/9/">
                </div>
                <div class="card-info"> 
                    <span class="card-title">{{Auth::user()->name}}</span>
                </div>
            </div>
            
            <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <button type="button" id="stars" class="btn btn-info" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                        <div class="hidden-xs">Pedidos</div>
                    </button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <div class="hidden-xs">Favoritos</div>
                    </button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        <div class="hidden-xs">Otro</div>
                    </button>
                </div>
            </div>

            <div class="well">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1">
                        <h3>Mis compras</h3>
                        @foreach($orders as $order)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <ul class="list-group">
                                @foreach($order->carro->items as $item)
                                    <li class="list-group-item"><span class="badge">$ {{$item['precio']}}</span>
                                        {{$item['item']['titulo']}} | {{$item['cantidad']}} Unidades
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                            <div class="panel-footer">Precio total: $ {{$order->carro->totalPrecio}}</div>
                        </div> 
                        @endforeach
                    </div>
                    <div class="tab-pane fade in" id="tab2">
                        <h3>Pestaña 2</h3>
                    </div>
                    <div class="tab-pane fade in" id="tab3">
                        <h3>Pestaña 3</h3>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
</div>
@endsection
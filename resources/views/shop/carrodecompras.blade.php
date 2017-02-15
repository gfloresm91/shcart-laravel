@extends('layouts.master')
@section('title', 'Carro de compras')

@section('content')
    <section id="cart_items">{{--Breadcumbs y Tabla--}}
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{route('product.index')}}">Inicio</a></li>
				  <li class="active">Carro de compras</li>
				</ol>
			</div>
			@include('partials.tablacarrocompras')
		</div>
	</section>{{--./Breadcumbs y Tabla--}}

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Datos de la compra</h3>
				<p>En este apartado se agrega el IVA y los gastos de envio.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Retiro en tienda</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Enviar</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Usar cupon de descuento</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Región:</label>
								{{--
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								--}}
							</li>
							<li class="single_field">
								<label>Ciudad:</label>
								{{--
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								--}}
							</li>
							{{--
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
							--}}
						</ul>
						{{--
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
						--}}
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Sub total <span>${{ !empty($totalPrecio) ? $totalPrecio : '0'}}</span></li>
							<li>IVA <span>19%</span></li>
							<li>Gastos de envio <span>$0</span></li>
							<li>Total <span>${{ !empty($totalPrecio) ? $totalPrecio * 1.19 : '0' }}</span></li>
						</ul>
							@if(!empty($totalPrecio))
								<a class="btn btn-default btn-block check_out" href="{{route('product.comprar')}}">Confirmar compra</a>
							@endif
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection
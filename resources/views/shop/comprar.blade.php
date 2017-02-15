@extends('layouts.master')

@section('title','Confirmar Compra')

@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{route('product.index')}}">Inicio</a></li>
				  <li class="active">Confirmar compra</li>
				</ol>
			</div><!--/breadcrums-->
			{{--
			<div class="step-one">
				<h2 class="heading">Paso 1</h2>
			</div>
			<div class="checkout-options">
				<h3>Nuevo usuario</h3>
				<p>Opciones</p>
				<ul class="nav">
					<li>
						<label><input type="checkbox"> Registrar una cuenta</label>
					</li>
					<li>
						<label><input type="checkbox"> Comprar sin cuenta</label>
					</li>
					<li>
						<a href=""><i class="fa fa-times"></i>Cancelar</a>
					</li>
				</ul>
			</div><!--/checkout-options-->

			<div class="register-req">
				<p>Por favor registrese para hacer mas sencillo el proceso de compra y que puedas acceder a tu historial de compras</p>
			</div><!--/register-req-->
			--}}
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h5>Por favor utilice estos datos para la tarjeta de credito</h5>
				</div>
				<div class="panel-body">
					<p>Numero de tarjeta: <strong>4242 4242 4242 4242</strong></p>
					<p>CVC: <strong>123</strong></p>
					<p>Código postal: <strong>12345</strong></p>
				</div>
			</div>
			<div id="checkout-errors" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : '' }}">
				{{ Session::get('error') }}
			</div>

			<div class="col-sm-12">
				@include('partials.notificaciones')
			</div>

			<div class="shopper-informations">
				<div class="row">
                {!! Form::open([
                                'route' => 'product.postcomprar', 
                                'method' => 'POST', 
                                'id' => 'checkout-form'
                                ]) !!}
                                
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Informacion del cliente</p>
                                <input type="text" placeholder="Nombres *" name="nombres" id="nombres">
								<input type="text" placeholder="Apellidos *" name="apellidos" id="apellidos">
								<input type="text" placeholder="Email*" name="email" id="email">
								<input type="text" placeholder="Dirección *" name="direccion" id="direccion">
                        </div>
					</div>
                    
                    <div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Metodo de pago</p>
							<div class="form-one">
								{{--
								<select name="metododepago" id="metododepago">
                                    <option value="seleccione" select>Seleccione</option>
                                    <option value="bancaria">Transferencia Bancaria</option>
                                    <option value="mastercard">Master Card</option>
                                    <option value="visa">Visa</option>
                                    <option value="paypal">Paypal</option>
                                </select>
                                <br />
                                <br />
								--}}
                                <input type="text" placeholder="Numero de tarjeta" name="numerotarjeta" data-stripe="number">
                                <input type="text" placeholder="Mes expiración" name="mesexpiracion" data-stripe="exp_month">
								<input type="text" placeholder="Año expiración" name="añoexpiracion" data-stripe="exp_year">
                                <input type="text" placeholder="CVC" name="tarjetacvc" data-stripe="cvc">
							</div>
							<div class="form-two">
									<input type="text" placeholder="Codigo Postal *" name="codigo_postal">
									<input type="text" placeholder="Telefono *" name="telefono">
									<input type="text" placeholder="Movil *" name="movil">
							</div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="order-message">
							<p>Añadir comentario</p>
							<textarea name="comentario"  placeholder="Acerca de su orden o algun dato adicional" rows="16"></textarea>
						</div>	
					</div>	
                    
                    <button type="submit" class="btn btn-primary btn-block">Comprar</button>
                    
                    {!! Form::close() !!}
									
				</div>
			</div>
			<div class="review-payment">
				<h2>Productos en el carro</h2>
			</div>

			@include('partials.tablacarrocompras')
			{{--
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
			</div>
			--}}
		</div>
	</section> <!--/#cart_items-->
@endsection

@section('scripts')
 <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
 <script type="text/javascript" src="{{asset('js/compra.js')}}"></script>
@endsection
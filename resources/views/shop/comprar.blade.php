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
                                
					<div class="col-sm-4">
						<div class="shopper-info">
							<p>Informacion del cliente</p>
                                <input type="text" placeholder="Nombres *" name="nombres" id="nombres">
								<input type="text" placeholder="Apellidos *" name="apellidos" id="apellidos">
								<input type="text" placeholder="Email*" name="email" id="email">
								<input type="text" placeholder="Dirección *" name="direccion" id="direccion">
                        </div>
					</div>

					<div class="col-sm-4 clearfix">
						<div class="bill-to">
							<p>Metodo de pago</p>
							<div class="form-one">
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

					<div class="clearfix"></div>
					<div class="col-sm-12">
						<p><strong>* El pago web sera realizado en dolares</strong></p>
					</div>

					<input type="hidden" id="stripeToken" name="stripeToken"/>
    				<input type="hidden" id="stripeEmail" name="stripeEmail"/>

					<script src="https://checkout.stripe.com/checkout.js"></script>

					<button id="customButton" type="submit" class="btn btn-block btn-primary">Comprar</button>

					<script>
					var handler = StripeCheckout.configure({
					key: '{{config('services.stripe.key')}}',
					image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
					locale: 'es',
					token: function(token) {
						// You can access the token ID with `token.id`.
						// Get the token ID to your server-side code for use.
						$("#stripeToken").val(token.id);
						$("#stripeEmail").val(token.email);
						$("#checkout-form").submit();
					}
					});

					document.getElementById('customButton').addEventListener('click', function(e) {
					// Open Checkout with further options:
					handler.open({
						name: 'Carro de compras Laravel',
						description: 'Simulador de compra en dolares',
						amount: {{$totalusd}}
					});
					e.preventDefault();
					});

					// Close Checkout on page navigation:
					window.addEventListener('popstate', function() {
					handler.close();
					});
					</script>
                    
                    {!! Form::close() !!}
									
				</div>
			</div>
			<div class="review-payment">
				<h2>Productos en el carro</h2>
			</div>

			@include('partials.tablacarrocompras')
		</div>
	</section> <!--/#cart_items-->
@endsection

@section('scripts')
 <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
@endsection
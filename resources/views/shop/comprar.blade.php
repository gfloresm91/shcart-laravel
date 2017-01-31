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

			<div id="checkout-errors" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : '' }}">
				{{ Session::get('error') }}
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
								<select name="metododepago" id="metododepago">
                                    <option value="seleccione" select>Seleccione</option>
                                    <option value="bancaria">Transferencia Bancaria</option>
                                    <option value="mastercard">Master Card</option>
                                    <option value="visa">Visa</option>
                                    <option value="paypal">Paypal</option>
                                </select>
                                <br />
                                <br />
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
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="cart_product">
								<a href=""><img src="images/cart/one.png" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">Colorblock Scuba</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>$59</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$59</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>

						<tr>
							<td class="cart_product">
								<a href=""><img src="images/cart/two.png" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">Colorblock Scuba</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>$59</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$59</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<tr>
							<td class="cart_product">
								<a href=""><img src="images/cart/three.png" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">Colorblock Scuba</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>$59</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$59</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>$59</td>
									</tr>
									<tr>
										<td>Exo Tax</td>
										<td>$2</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>$61</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
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
		</div>
	</section> <!--/#cart_items-->
@endsection

@section('scripts')
 <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
@endsection
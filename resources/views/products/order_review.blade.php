<?php
	use App\Product;
?>
@extends('layouts.frontLayout.front_design')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Order Review</li>
				</ol>
	   	</div>
			<div class="shopper-informations">
			<div class="row">
				@if(Session::has('flash_message_error'))  
		            <div class="alert alert-danger alert-block">
		                <button type="button" class="close" data-dismiss="alert">x</button>
		                <strong>{{ session::get('flash_message_error') }}</strong>
		            </div>
		        @endif 
			<div class="col-sm-4 col-sm-offset-1">
				<div class="login-form">
					<h2>Billing Details</h2>
					  <div class="form-group">
						  <b><span>Name: </span></b>{{ $user->name }}
						</div>
						<div class="form-group">
						  <b><span>Address: </span></b>{{ $user->address }}
						</div>
						<div class="form-group">
						  <b><span>City: </span></b>{{ $user->city }}
						</div>
						<div class="form-group">
						  <b><span>State: </span></b>{{ $user->state }}
						</div>
						<div class="form-group">
							<b><span>Country: </span></b>{{ $user->country->name }}  
						</div>
						<div class="form-group">
						  <b><span>Pincode: </span></b>{{ $user->pincode }}
						</div>
						<div class="form-group">
						  <b><span>Mobile#: </span></b>{{ $user->mobile }}
						</div>
				</div>
			</div>
			<div class="col-sm-1">
			</div>
			<div class="col-sm-4">
				<div class="signup-form"><!-- form-->
					<h2>Shipping Details</h2>
						<div class="form-group">
						  <b><span>Name: </span></b>{{ $shipping_address->name }}
						</div>
						<div class="form-group">
						  <b><span>Address: </span></b>{{ $shipping_address->address }}
						</div>
						<div class="form-group">
						  <b><span>City: </span></b>{{ $shipping_address->city }}
						</div>
						<div class="form-group">
						  <b><span>State: </span></b>{{ $shipping_address->state }}
						</div>
						<div class="form-group">
							<b><span>Country: </span></b>{{ $user->country->name }}  
						</div>
						<div class="form-group">
						  <b><span>Pincode: </span></b>{{ $shipping_address->pincode }}
						</div>
						<div class="form-group">
						  <b><span>Mobile#: </span></b>{{ $shipping_address->mobile }}
						</div>
					</div>
			</div>
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
						@php $total_amount = 0; @endphp
						@foreach($userCart as $cart)
							<tr>
								<td class="cart_product">
									<a href=""><img src="{{ asset('/images/backend_images/products/small/'.$cart->product->image) }}" alt="" width="70px;"></a>
								</td>
								<td class="cart_description">
								  <h4><a href="">{{$cart->product_name}}</a></h4>
								  <p>{{$cart->product_code}} | {{$cart->size}}</p>
							  </td>
								<td class="cart_price">
									<p>PKR:{{$cart->product_price}}</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<a class="cart_quantity_up" href="{{url('/cart/upadte-quantity/'.$cart->id.'/1')}}"> + </a>
										<input class="cart_quantity_input" type="text" name="quantity" value="{{ $cart->quantity }}" autocomplete="off" size="2" readonly>
										@if($cart->quantity > 1)
										<a class="cart_quantity_down" href="{{url('/cart/upadte-quantity/'.$cart->id.'/-1')}}"> - </a>
										@endif
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">PKR:{{$cart->product_price * $cart->quantity  }}</p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href="{{ url('/cart/delete-product/'.$cart->id) }}"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							@php $total_amount += ($cart->product_price * $cart->quantity); @endphp
						@endforeach
							<tr>
								<td colspan="4">&nbsp;</td>
								<td colspan="2">
									<table class="table table-condensed total-result">
										<tr>
											<td>Cart Sub Total</td>
											<td>PKR {{ $total_amount }}</td>
										</tr>
										<tr>
											<td>Shipping Cost(+)</td>
											<td>PKR {{$shipping_charges}}</td>
										</tr>
										<tr class="shipping-cost">
											<td>Discount(-)</td>
											@if(!empty(Session::get('CouponAmount')))
											<td>PKR {{Session::get('CouponAmount')}}</td>	
											@else
											<td>PKR 0</td>
											@endif									
										</tr>
										<tr>
											<?php
												$total_amount = $total_amount - Session::get('CouponAmount') + $shipping_charges;
						            $currencyRate = Product::getCurrencies($total_amount); 
											?>
											<td>Grand Total</td>
											<td><span class="btn-secondary" data-toggle="tooltip" data-html="true" 
					                    	title="Yuan {{$currencyRate['Yuan_Rate']}}<br>
							                         EUR  {{$currencyRate['EUR_Rate']}}<br>
							                         USD  {{$currencyRate['USD_Rate']}}">
							              PKR {{$total_amount}}</span></td>
										</tr>
									</table>
								</td>
							</tr>
					</tbody>
				</table>
			</div>
			<form method="post" action="{{url('place-order')}}" name="paymentForm" id="paymentForm">
				{{ csrf_field() }}
				<input type="hidden" name="grand_total" value="{{ $total_amount }}">
				<input type="hidden" name="coupon_code" value="{{ Session::get('CouponCode') }}">
				<input type="hidden" name="coupon_amount" value="{{ Session::get('CouponAmount') }}">
				<input type="hidden" name="shipping_charges" value="{{$shipping_charges}}">
				<div class="payment-options">
					<span>
						<label><strong>Select Payment Method:</strong></label>
					</span>
					<span>
						<label><input type="radio" name="payment_method" id="COD" value="COD"><strong> COD</strong></label>
					</span>
					<span>
						<label><input type="radio" name="payment_method	" id="Paypal" value="Paypal"><strong> Paypal</strong></label>
					</span>
					<span >
						<input type="submit" class="btn btn-default check_out" value="Place Order" style="margin-top: -5px;" onclick="return selectPaymentMethod();">
					</span>
				</div>
			</form>
		</div>
	</section> <!--/#cart_items-->

@endsection
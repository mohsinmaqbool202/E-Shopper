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
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				 @if(Session::has('flash_message_success'))  
			        <div class="alert alert-success alert-block">
			            <button type="button" class="close" data-dismiss="alert">x</button>
			            <strong>{{ session::get('flash_message_success') }}</strong>
			        </div>
			      @endif 
			      @if(Session::has('flash_message_error'))  
			        <div class="alert alert-danger alert-block">
			            <button type="button" class="close" data-dismiss="alert">x</button>
			            <strong>{{ session::get('flash_message_error') }}</strong>
			        </div>
			      @endif 
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
								<?php
									$price = Product::getProductPrice($cart->product_id,$cart->product_code);
								?>
								<p>PKR:{{$price}}</p>
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
					</tbody>
				</table>
			</div>
		</div>
</section> <!--/#cart_items-->

<section id="do_action">
	<div class="container">
		<div class="heading">
			<h3>What would you like to do next?</h3>
			<p>Choose if you have a Coupon code you want to use.</p>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="chose_area">
					<ul class="user_option">
						<li>
							<form action="{{ url('/cart/apply-coupon') }}" method="post">
								{{csrf_field()}}
								<label>Coupon Code</label>
								<input type="text" name="coupon_code">
								<input type="submit" value="Apply" class="btn btn-default">
						    </form>  
						</li>
					</ul>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="total_area">
					<ul>
						@if(!empty(Session::get('CouponAmount')))
						<?php 
						 $total_amount = $total_amount - Session::get('CouponAmount');
						  $currencyRate = Product::getCurrencies($total_amount); 
						?>
						<li>Sub Total <span>PKR {{$total_amount}}</span></li>
						<li>Coupon Discount<span>PKR {{Session::get('CouponAmount')}}</span></li>
						<li>Grand Total <span class="btn-secondary" data-toggle="tooltip" data-html="true" 
						title="Yuan {{$currencyRate['Yuan_Rate']}}<br>
							   EUR  {{$currencyRate['EUR_Rate']}}<br>
							   USD  {{$currencyRate['USD_Rate']}}">PKR {{$total_amount - Session::get('CouponAmount')}}</span></li>
						@else
						<?php 
						  $currencyRate = Product::getCurrencies($total_amount);
						?>
						<li>Grand Total <span class="btn-secondary" data-toggle="tooltip" data-html="true" 
						title="Yuan {{$currencyRate['Yuan_Rate']}}<br>
							   EUR  {{$currencyRate['EUR_Rate']}}<br>
							   USD  {{$currencyRate['USD_Rate']}}">
						 PKR {{$total_amount}}</span></li>
						@endif
					</ul>
						<a class="btn btn-default update" href="{{url('/')}}">Update</a>
						<a class="btn btn-default check_out" href="{{url('/checkout')}}">Check Out</a>
				</div>
			</div>
		</div>
	</div>
</section><!--/#do_action-->

@endsection
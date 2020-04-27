@extends('layouts.frontLayout.front_design')
@section('content')

<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="{{ url('/') }}">Home</a></li>
			  <li><a href="{{ url('/orders') }}">Orders</a></li>
			  <li class="active">{{ $orderDetail->id }}</li>
			</ol>
		</div>
	</div>
</section> 

<section id="do_action">
	<div class="container">
		<div class="heading">
			<table id="example" class="table table-striped table-bordered">
				<thead>
					<tr>
					 <th>Product Code</th>
					 <th>Product Name</th>
					 <th>Product Size</th>
					 <th>Product Color</th>
					 <th>Product Price</th>
					 <th>Product Quantity</th>
					</tr> 
				</thead>	
				<tbody>
					@foreach($orderDetail->orders as $pro)
					<tr>
						<td>{{$pro->cart->product_code}}</td>
						<td>{{$pro->cart->product_name}}</td>
						<td>{{$pro->cart->size}}</td>
						<td>{{$pro->cart->product_color}}</td>
						<td>{{$pro->cart->product_price}}</td>
						<td>{{$pro->cart->quantity}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</section>

@endsection

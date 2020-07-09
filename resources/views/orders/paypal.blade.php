@extends('layouts.frontLayout.front_design')
@section('content')

<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Thanks</li>
			</ol>
		</div>
	</div>
</section> 

<section id="do_action">
	<div class="container">
		<div class="heading" align="center">
			<h3>Your Order has been placed.</h3>
			<p>Your order number is {{ Session::get('order_id') }} and total payable amount is {{ Session::get('grand_total') }}</p>
			<p>Please make payment by clicking on below Payment Button.</p>

			<form action="{{url('/paypal')}}" method="post">
				{{csrf_field()}}
			   <div class="form-group" style="width: 230px;">
			   <input type="text" name="amount" id="amount" value="{{ Session::get('grand_total') }}" readonly class="form-control">
			   <input type="submit" value="Pay with Paypal" class="btn btn-primary btn-mini">
			   </div>  
			</form>

		</div>
	</div>
</section>

@endsection

@section('extraScript')
<script>
	@if(Session::has('message'))
		var type="{{Session::get('alert type')}}";
		switch(type)
		{
	      case 'error':
	        toastr.error("{{ Session::get('message', 'Error') }}");
	        break;
		}
	@endif
</script>
@endsection

@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style="margin-top: 20px;"><!--form-->
	<div class="container">
  	<form action="#">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!-- form-->
						<h2>Bill To</h2>
						  <div class="form-group">
							  <input type="text" name="billing_name" id="billing_name" value="{{ $user->name }}" placeholder="Billing Name" class="form-control" />
							</div>
							<div class="form-group">
							  <input type="text" name="billing_address" id="billing_address" value="{{ $user->address }}" placeholder="Billing Address" class="form-control" />
							</div>
							<div class="form-group">
							  <input type="text" name="billing_city" id="billing_city" value="{{ $user->city }}" placeholder="Billing City" class="form-control" />
							</div>
							<div class="form-group">
							  <input type="text" name="billing_state" id="billing_state" value="{{ $user->state }}" placeholder="Billing State" class="form-control" />
							</div>
							<div class="form-group">
							  <select name="country_id" id="country_id">
						       <option selected disabled>Select Country</option>		
								 @foreach($countries as $country)
								   <option value="{{ $country->id }}" @if($country->id == $user->country_id)selected @endif>{{ $country->name }}</option>
								 @endforeach	
								</select>
							</div>
							<div class="form-group">
							  <input type="text" name="billing_pincode" id="billing_pincode" value="{{ $user->pincode }}" placeholder="Billing Pincode" class="form-control" />
							</div>
							<div class="form-group">
							  <input type="text" name="billing_mobile" id="billing_mobile" value="{{ $user->mobile }}" placeholder="Billing Mobile" class="form-control" />
							</div>
							<div class="form-check">
                  <input type="checkbox" value="{{ $user->name }}" class="form-check-input" id="copyAddress">
                  <label class="form-check-label" for="copyAddress">Shipping Address same as Billing Address</label>
              </div>
					</div>
				</div>
				<div class="col-sm-1">
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!-- form-->
						<h2>Ship To</h2>
							<div class="form-group">
							  <input type="text" name="shipping_name" id="shipping_name" placeholder="Shipping Name" class="form-control" />
							</div>
							<div class="form-group">
							  <input type="text" name="shipping_address" id="shipping_address" placeholder="Shipping Address" class="form-control" />
							</div>
							<div class="form-group">
							  <input type="text" name="shipping_city" id="shipping_city" placeholder="Shipping City" class="form-control" />
							</div>
							<div class="form-group">
							  <input type="text" name="shipping_state" id="shipping_state" placeholder="Shipping State" class="form-control" />
							</div>
							<div class="form-group">
							  <select name="shipping_country_id" id="shipping_country_id">
						       <option value = '' selected disabled>Select Country</option>		
								 @foreach($countries as $country)
								   <option value="{{ $country->id }}">{{ $country->name }}</option>
								 @endforeach	
								</select>
							</div>
							<div class="form-group">
							  <input type="text" name="shipping_pincode" id="shipping_pincode" placeholder="Shipping Pincode" class="form-control" />
							</div>
							<div class="form-group">
							  <input type="text" name="shipping_mobile" id="shipping_mobile" placeholder="Shipping Mobile" class="form-control" />
							</div>
							<div class="form-group">
							  <input type="submit" value="Checkout" class="btn btn-warning">
							</div>
						</div><!--/ form-->
				</div>
			</div>
    </form>	
	</div>
</section><!--/form-->

@endsection
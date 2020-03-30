@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style="margin-top: 20px;">
		<div class="container">
			<div class="row">
				 @if(Session::has('flash_message_success'))  
		        <div class="alert alert-success">
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
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form">
						<h2>Update Account</h2>
						<form id="accountForm" action="{{ url('/account') }}" method="post">
							{{ csrf_field() }}
							<input id="name" name="name" type="text" value="{{ $user->name }}" placeholder="Name"/>	
							<input id="address" name="address" type="text" value="{{ $user->address }}" placeholder="Address"/>
							<input id="city" name="city" type="text" value="{{ $user->city }}" placeholder="City"/>
							<input id="state" name="state" type="text" value="{{ $user->state }}" placeholder="State" />
							<select name="country_id" id="country_id">
						       <option selected disabled>Select Country</option>		
							 @foreach($countries as $country)
							   <option value="{{ $country->id }}" @if($country->id == $user->country_id)selected @endif>{{ $country->name }}</option>
							 @endforeach	
							</select>
							<input id="pincode" name="pincode" type="text" value="{{ $user->pincode }}" placeholder="Pincode" style="margin-top: 10px;"/>
							<input id="mobile" name="mobile" type="text" value="{{ $user->mobile }}" placeholder="Mobile"/>
							<button type="submit" class="btn btn-default">Update</button>
						</form>
					</div>
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form">
						<h2>Update Password</h2>
						<form id="account_Form" action="{{ url('/update_user_pwd') }}" method="post">
							{{ csrf_field() }}
							<input type="password" name="current_pwd" id="current_pwd" placeholder="Current Password"/>
              <span id="chkPwd"></span>
              <input type="password" name="new_pwd" id="new_pwd" placeholder="New Password" />
              <input type="password" name="confirm_pwd" id="confirm_pwd" placeholder="Confirm Password"/>
							<button type="submit" class="btn btn-default">Update</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

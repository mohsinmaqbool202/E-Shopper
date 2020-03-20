@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style="margin-top: 20px;">
		<div class="container">
			<div class="row">
				@if(Session::has('flash_message_error'))  
			        <div class="alert alert-error alert-block" style="background-color: #f4d2d2">
			            <button type="button" class="close" data-dismiss="alert">x</button>
			            <strong>{{ session::get('flash_message_error') }}</strong>
			        </div>
				@endif 
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form">
						<h2>Update Account</h2>
					</div>
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form">
						<h2>Update Password</h2>
						
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

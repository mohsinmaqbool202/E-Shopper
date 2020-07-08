<?php
  use App\Http\Controllers\Controller;
  use App\Product;

  $mainCategories = Controller::mainCategories();
  $cartCount = Product::cartCount();
?>
<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +92 302 3831605</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> mohsinmaqbool451@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="https://www.facebook.com/mohsin.mughal.50999" target="_blank"><i class="fa fa-facebook"></i></a></li>
								<li><a href="https://twitter.com/MohsinM89334194"><i class="fa fa-twitter"></i></a></li>
								<li><a href="https://www.linkedin.com/in/mohsin-maqbool-bb2428187/"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="https://www.instagram.com/mohsin4540/"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{ url('/') }}"><img src="{{ asset('images/frontend_images/home/logo.png') }}" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="{{url('/wish-list')}}"><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="{{url('/orders')}}"><i class="fa fa-crosshairs"></i> Orders</a></li>
								<li><a href="{{ url('/cart') }}"><i class="fa fa-shopping-cart"></i> Cart ({{$cartCount}})</a></li>
								@if(empty(Auth::check()))
								  <li><a href="{{ url('/login-register') }}"><i class="fa fa-lock"></i> Login</a></li>
								@else
								  <li><a href="{{ url('/account') }}"><i class="fa fa-user"></i> Account</a></li>
								  <li><a href="{{ url('/user-logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ url('/') }}" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
				                  <ul role="menu" class="sub-menu">
				                  	@foreach($mainCategories as $cat)
				                    	@if($cat->status == 1)
				                        <li><a href="{{ asset('/products/'.$cat->url) }}">{{ $cat->name }}</a></li>
				                      @endif   
				                    @endforeach   
				                  </ul>
				                </li> 
								<li><a href="{{url('/contact-us')}}">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<form method="post" action="{{ url('/search-pruducts') }}">
							{{ csrf_field() }}
							<div class="search_box pull-right">
								<input type="text" placeholder="Search Product" name="product" autofocus />
								<button type="submit" title="Search" class="btn btn-warning" style="margin-left: -4px; height: 35px; border-radius: 0px;"><i class="fa fa-search"></i></button>
							</div>
					  </form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
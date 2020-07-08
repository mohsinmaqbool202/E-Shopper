@extends('layouts.frontLayout.front_design')
@section('content')
<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<?php $i = 0; ?>
							@foreach($banners as $banner)
							<li data-target="#slider-carousel" data-slide-to="{{ $i }}" @if($i == 0) class="active" @endif></li>
							<?php $i = $i+1; ?>
							@endforeach
						</ol>
						
						<div class="carousel-inner">
							<?php $i = 0; ?>
							@foreach($banners as $banner)
							<div class="item @if($i == 0)active @endif">
								<a href="{{url('/'.$banner->link)}}"><img src="{{ asset('/images/frontend_images/banners/'.$banner->image) }}"></a>
							</div>
							<?php $i = $i+1; ?>
							@endforeach
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
</section><!--/slider-->
	
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				@include('layouts.frontLayout.front_sidebar')
			</div>
			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center">Feature Items</h2>
					@foreach($products as $product)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{ asset( 'images/backend_images/products/small/'.$product->image)}}" alt="" />
											<h2>PKR {{$product->price}}</h2>
											<p>{{ $product->product_name }}</p>
											<a href="{{ url('product/'.$product->id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>PKR {{$product->price}}</h2>
												<p>{{ $product->product_name }}</p>
												<a href="{{ url('product/'.$product->id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li>
											<form action="javascript::void(0);" style="padding-left: 85px;" class="wishlist_form">

											<input type="hidden" name="user_email" value="{{auth::check()}}">
											<input type="hidden" name="product_id" value="{{$product->id}}">
											<a href="javascript::void(0);" class="addToWishList"><i class="fa fa-plus-square"></i>Add to wishlist</a>
										    </form>
										</li>
									</ul>
								</div>
							</div>
						</div>
					@endforeach
				</div><!--features_items-->
				<div align="center">{{$products->links()}}</div>
			</div>
		</div>
	</div>
</section>
@endsection	

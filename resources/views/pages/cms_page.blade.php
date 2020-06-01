@extends('layouts.frontLayout.front_design')
@section('content')
	
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				@include('layouts.frontLayout.front_sidebar')
			</div>
			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center">{{ $cmsPage->title }}</h2>
					<p>{{ $cmsPage->description }}</p>
				</div><!--features_items-->
			</div>
		</div>
	</div>
</section>
@endsection
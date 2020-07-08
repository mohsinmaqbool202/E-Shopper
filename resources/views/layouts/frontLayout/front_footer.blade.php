@php
  use App\Http\Controllers\CmsController;

  $pages = CmsController::fetchPages();
@endphp
<footer id="footer"><!--Footer-->
	<div class="footer-widget">
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>Service</h2>
						<ul class="nav nav-pills nav-stacked">
							@foreach($pages['servicePages'] as $page)
							<li><a href="{{ url('page/'.$page->url) }}">{{$page->title}}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>Quick Shop</h2>
						<ul class="nav nav-pills nav-stacked">
							@foreach($pages['quickShopPages'] as $page)
							<li><a href="{{ url('page/'.$page->url) }}">{{$page->title}}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>Policies</h2>
						<ul class="nav nav-pills nav-stacked">
							@foreach($pages['policyPages'] as $page)
							<li><a href="{{ url('page/'.$page->url) }}">{{$page->title}}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>About Shopper</h2>
						<ul class="nav nav-pills nav-stacked">
							@foreach($pages['aboutPages'] as $page)
							<li><a href="{{ url('page/'.$page->url) }}">{{$page->title}}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-sm-3 col-sm-offset-1">
					<div class="single-widget">
						<h2>About Shopper</h2>
						<form action="{{ url('/newsletter-subscribe') }}" class="searchform" method="post" novalidate>
							{{csrf_field()}}

							<input id="email" type="email" name="email" placeholder="Enter Your Email" required>
            
							<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
            <span style="color:red;" role="alert"> {{ $errors->first('email') }} </span>
							<p style="color:blue;">Get the most recent updates from <br />our site and be updated your self...</p>

						</form>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
				<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Mohsin .co</a></span></p>
			</div>
		</div>
	</div>	
</footer><!--/Footer-->

@section('extraScript')
<script>
	@if(Session::has('message'))
		var type="{{Session::get('alert type')}}"
		switch(type)
		{
      case 'success':
          toastr.success("{{ Session::get('message') }}");
          break;
      case 'error':
        toastr.error("{{ Session::get('message') }}");
        break;
		}
	@endif
</script>
@endsection



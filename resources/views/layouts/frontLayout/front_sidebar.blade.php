<?php
use App\Product;
?>

<form method="post" action="{{ url('/products/filter') }}">
	{{csrf_field()}}
	@if(!empty($url))
	<input type="hidden" name="url" value="{{$url}}">
	@endif
	<div class="left-sidebar">
		<h2>Category</h2>
		<div class="panel-group category-products" id="accordian"><!--Categories-->
			<div class="panel panel-default">
				<?php //echo $categories_menu ?>
				@foreach($categories as $cat)
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordian" href="#{{ $cat->id }}">
								<span class="badge pull-right"><i class="fa fa-plus"></i></span>
								{{$cat->name}}
							</a>
						</h4>
					</div>
					<div id="{{ $cat->id }}" class="panel-collapse collapse">
						<div class="panel-body">
							<ul>
								@foreach($cat->categories as $subcat)
								<li><a href="{{ asset('/products/'.$subcat->url) }}">{{ $subcat->name }} ({{Product::productCount($subcat->id)}})</a></li>
								@endforeach
							</ul>
						</div>
					</div>
				@endforeach
			</div>
		</div><!--/category-products-->
	    @if(!empty($url))
			<h2>Colors</h2>
			<div class="panel-group "><!--colors-->
				@if(!empty($_GET['color']))
				    <?php  
				 		$colorArray = explode('-', $_GET['color']);
				   ?>
				@endif
				@foreach($colors as $color)
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<input type="checkbox" name="colorFilter[]" id="{{$color->product_color}}" value="{{$color->product_color}}" onchange="javascript:this.form.submit();" @if(!empty($colorArray) && in_array($color->product_color, $colorArray)) checked @endif><span class="products-colors">&nbsp;&nbsp; {{$color->product_color}}</span>
							</h4>
						</div>
					</div>
				@endforeach
			</div>	<!-- end colors -->
			<div>&nbsp;</div>

			<h2>Sleeve</h2>
			<div class="panel-group "><!--sleeve-->
				@if(!empty($_GET['sleeve']))
				    <?php  
				 		$sleeveArray = explode('-', $_GET['sleeve']);
				    ?>
				@endif
				@foreach($sleeves as $sleeve)
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<input type="checkbox" name="sleeveFilter[]" id="{{$sleeve->sleeve}}" value="{{$sleeve->sleeve}}" onchange="javascript:this.form.submit();" @if(!empty($sleeveArray) && in_array($sleeve->sleeve, $sleeveArray)) checked @endif><span class="products-colors">&nbsp;&nbsp; {{$sleeve->sleeve}}</span>
							</h4>
						</div>
					</div>
				@endforeach
			</div>	<!-- end sleeve -->
			<div>&nbsp;</div>

			<h2>Pattern</h2>
			<div class="panel-group "><!--patterns-->
				@if(!empty($_GET['pattern']))
				    <?php  
				 		$patternArray = explode('-', $_GET['pattern']);
				    ?>
				@endif
				@foreach($patterns as $pattern)
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<input type="checkbox" name="patternFilter[]" id="{{$pattern->pattern}}" value="{{$pattern->pattern}}" onchange="javascript:this.form.submit();" @if(!empty($patternArray) && in_array($pattern->pattern, $patternArray)) checked @endif><span class="products-colors">&nbsp;&nbsp; {{$pattern->pattern}}</span>
							</h4>
						</div>
					</div>
				@endforeach
			</div>	<!-- end patterns -->
			<div>&nbsp;</div>

			<h2>Size</h2>
			<div class="panel-group "><!--patterns-->
				@if(!empty($_GET['size']))
				    <?php  
				 		$sizeArray = explode('-', $_GET['size']);
				    ?>
				@endif
				@foreach($sizes as $size)
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<input type="checkbox" name="sizeFilter[]" id="{{$size->size}}" value="{{$size->size}}" onchange="javascript:this.form.submit();" @if(!empty($sizeArray) && in_array($size->size, $sizeArray)) checked @endif><span class="products-colors">&nbsp;&nbsp; {{$size->size}}</span>
							</h4>
						</div>
					</div>
				@endforeach
			</div>	<!-- end patterns -->
			<div>&nbsp;</div>
		@endif
	</div>
</form>
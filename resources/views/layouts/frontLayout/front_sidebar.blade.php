<?php
use App\Product;
?>

<form method="post" action="{{ url('/products/filter') }}">
	{{csrf_field()}}
	<input type="hidden" name="url" value="{{$url}}">
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

		<h2>Colors</h2>
		<div class="panel-group "><!--colors-->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<input type="checkbox" name="colorFilter[]" id="Black" value="Black" onchange="javascript:this.form.submit();"><span class="products-colors">&nbsp;&nbsp; Black</span>
					</h4>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<input type="checkbox" name="colorFilter[]" id="Blue" value="Blue" onchange="javascript:this.form.submit();"><span class="products-colors">&nbsp;&nbsp; Blue</span>
					</h4>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<input type="checkbox" name="colorFilter[]" id="Red" value="Red" onchange="javascript:this.form.submit();"><span class="products-colors">&nbsp;&nbsp; Red</span>
					</h4>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<input type="checkbox" name="colorFilter[]" id="Green" value="Green" onchange="javascript:this.form.submit();"><span class="products-colors">&nbsp;&nbsp; Green</span>
					</h4>
				</div>
			</div>
		</div>	<!-- end colors -->
	</div>
</form>
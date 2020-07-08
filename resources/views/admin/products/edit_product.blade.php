 @extends('layouts.adminLayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Product</a> <a href="#" class="current">Edit Product </a> </div>
  </div>
   @if(Session::has('flash_message_success'))  
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ session::get('flash_message_success') }}</strong>
    </div>
   @endif 
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Product Details</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/edit-product', $product->id) }}" name="edit_product" id="edit_product" novalidate="novalidate">
              {{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Category Name</label>
                <div class="controls">
                 <select name="category_id" id="category_id" style="width: 220px;">
                  <?php echo $categories_dropdown; ?>
                 </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Name</label>
                <div class="controls">
                  <input type="text" name="product_name" id="product_name" value="{{ $product->product_name }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Code</label>
                <div class="controls">
                  <input type="text" name="product_code" id="product_code" value="{{ $product->product_code }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Color</label>
                <div class="controls">
                  <input type="text" name="product_color" id="product_color" value="{{ $product->product_color }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Price</label>
                <div class="controls">
                  <input type="text" name="price" id="price" value="{{ $product->price }}">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Weight</label>
                <div class="controls">
                  <input type="text" name="weight" id="weight" value="{{ $product->weight }}" placeholder="weight in grams">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Sleeve</label>
                <div class="controls">
                  <select name="sleeve" style="width: 220px;">
                    <option >Select</option>
                    @foreach($sleeveArr as $sleev)
                     <option value="{{$sleev}}" @if($product->sleeve == $sleev)selected @endif>{{$sleev}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Pattern</label>
                <div class="controls">
                  <select name="pattern" style="width: 220px;">
                    <option >Select Pattern</option>
                    @foreach($patternArr as $pattern)
                     <option value="{{$pattern}}" @if($product->pattern == $pattern)selected @endif>{{$pattern}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea name="description" id="description" rows="8" class="textarea_editor span8">{{ $product->description }}</textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Material & Care</label>
                <div class="controls">
                  <textarea name="care" id="care" rows="8" class="textarea_editor_2 span8">{{ $product->care }}</textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                  <input type="file" name="image" id="image">
                  @if(!empty($product->image))
                  <input type="hidden" name="current_image" value="{{ $product->image }}">
                  <img src="{{ asset('/images/backend_images/products/small/'.$product->image) }}" style="width: 40px;"> | <a href="{{ url('/admin/delete-product-image/'.$product->id) }}">Delete</a>
                  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Video</label>
                <div class="controls">
                  <input type="file" name="video" id="video">
                  @if(!empty($product->video))
                  <input type="hidden" name="current_video" value="{{ $product->video }}">
                  <a target="_blank" href="{{url('videos/'.$product->video)}}">View</a>
                  <a href="{{ url('/admin/delete-product-video/'.$product->id)}}"> | Delete</a>
                  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Enable Product</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" @if($product->status ===1 )checked value = "1" @endif >
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Feature Item</label>
                <div class="controls">
                  <input type="checkbox" name="feature_item" id="feature_item" @if($product->feature_item ===1 )checked value = "1" @endif >
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Save Changes" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

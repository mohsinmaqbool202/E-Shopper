 @extends('layouts.adminLayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">List</a> </div>
      @if(Session::has('flash_message_error'))  
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session::get('flash_message_error') }}</strong>
        </div>
      @endif 
      @if(Session::has('flash_message_success'))  
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session::get('flash_message_success') }}</strong>
        </div>
      @endif 
  </div>
  <div style="margin-top: 10px; margin-right: 10px;">
    <a href="{{ url('/admin/export-products') }}" class="btn btn-info pull-right">Export</a>
  </div> 
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Products</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Product Name</th>
                  <th width="7%">Image</th>
                  <th>Category Name</th>
                  <th>Product Code</th>
                  <th>Product Color</th>
                  <th>Price</th>
                  <th>status</th>
                  <th>Feature Item</th>
                  <th width="23%"></th>
                </tr>
              </thead>
              <tbody>
              	@foreach($products as $product)
               <tr class="gradeX">
                  <td>{{ $product->id }}</td>
                  <td>{{ $product->product_name }}</td>
                  <td>
                    <img src="{{ asset('/images/backend_images/products/small/'.$product->image) }}" style="width: 60px;">
                  </td>
                  <td> {{$product->category->name}}</td>
                  <td>{{ $product->product_code }}</td>
                  <td>{{ $product->product_color }}</td>
                  <td>PKR:{{ $product->price }}</td>
                  <td>@if($product->status == 1) Active @else Inactive @endif</td>
                  <td>@if($product->feature_item == 1) Yes @else No @endif</td>
                  <td class="center">
                    <a href="#myModal{{ $product->id }}" data-toggle="modal" class="btn btn-success btn-mini" title="View Product">View </a> 
                    <a href="{{ url('/admin/edit-product', $product->id) }}" class="btn btn-primary btn-mini" title="Edit Product">Edit</a> 
                    <a href="{{ url('/admin/add-attributes', $product->id) }}" class="btn btn-success btn-mini" title="Add Product Attributes">Add </a> 
                    <a href="{{ url('/admin/add-images', $product->id) }}" class="btn btn-info btn-mini" title="Add Images">Add Images </a>
                    <a rel="{{ $product->id }}" rel1="delete-product" href="javascript:" class="btn btn-danger btn-mini deleteRecord" title="Delete Product">Delete</a>
                  </td>
               </tr>

               <!-- PopUp Modal -->
                  <div id="myModal{{ $product->id }}" class="modal hide">
                     <div class="modal-header " style="background: #6495ED;;">
                        <button data-dismiss="modal" class="close" type="button">×</button>
                        <h3 style="color: white;">{{ $product->product_name }} Full Details</h3>
                     </div>
                     <div class="modal-body">
                        <img src="{{ asset('/images/backend_images/products/small/'.$product->image) }}" style="width: 60px;">
                        <p>Product Name: {{ $product->product_name }}</p>
                        <p>Product Code: {{ $product->product_code }}</p>
                        <p>Product Color: {{ $product->product_color }}</p>
                        <p>Category: {{ $product->category->Name }}</p>
                        <p>Price: {{ $product->price }}</p>
                        <p>Description: {{ $product->description }}</p>
                     </div>
                  </div>
               <!-- End PopupModal -->
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

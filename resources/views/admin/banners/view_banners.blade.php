 @extends('layouts.adminLayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Banners</a> <a href="#" class="current">List</a> </div>
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
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Banners</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Link</th>
                  <th width="25%">Image</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              	@foreach($banners as $banner)
               <tr class="gradeX">
                  <td>{{ $banner->id }}</td>
                  <td>{{ $banner->title }}</td>
                  <td>{{ $banner->link }}</td>
                  <td><img src="{{ asset('/images/frontend_images/banners/'.$banner->image) }}" style="width: 250px; height: 50px"></td>
                  <td>@if($banner->status == 1)Active @else In-Active @endif</td>
                  <td class="center">
                    <a href="{{ url('/admin/edit-banner/'.$banner->id) }}" class="btn btn-primary btn-mini" title="Edit Banner">Edit</a> 
                    <a rel="{{ $banner->id }}" rel1="delete-banner" href="javascript:" class="btn btn-danger btn-mini deleteRecord" title="Delete Banner">Delete</a>
                  </td>
               </tr>
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

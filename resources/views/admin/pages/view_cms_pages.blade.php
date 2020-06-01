 @extends('layouts.adminLayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">CMS Pages</a> <a href="#" class="current">List</a> </div>
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
            <h5>CMS Pages</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Url</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              	@foreach($cmsPages as $page)
               <tr class="gradeX">
                  <td>{{ $page->id }}</td>
                  <td>{{ $page->title }}</td>
                  <td>{{ $page->description}}</td>
                  <td>{{ $page->url }}</td>
                  <td>
                    @if($page->status == 1)<span class="badge badge-success">Active</span>@else<span class="badge badge-danger">InActive</span>@endif
                  </td>
                  <td class="center">
                    <a href="#myModal{{ $page->id }}" data-toggle="modal" class="btn btn-success btn-mini" title="View detail">View </a> 
                    <a href="{{url('/admin/edit-cms-page/'.$page->id)}}" class="btn btn-primary btn-mini" title="Edit page">Edit</a> 
                    <a rel="{{ $page->id }}" rel1="delete-cms-page" href="javascript:" class="btn btn-danger btn-mini deleteRecord" title="Delete Page">Delete</a>
                  </td>
               </tr>

               <!-- PopUp Modal -->
                  <div id="myModal{{ $page->id }}" class="modal hide">
                     <div class="modal-header " style="background: #6495ED;">
                        <button data-dismiss="modal" class="close" type="button">×</button>
                        <h3 style="color: white;">Full Details</h3>
                     </div>
                     <div class="modal-body">
                        <p><strong>Page Title:</strong> {{ $page->title }}</p>
                        <p><strong>Page url:</strong> {{ $page->url }}</p>
                        <p><strong>page status:</strong>@if($page->status == 1)<span class="badge badge-success">Active</span>@else<span class="badge badge-danger">InActive</span>@endif</p>
                        <p><strong>Page Description:</strong> {{ $page->description }}</p>
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

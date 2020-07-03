@php
use \App\Http\Controllers\ProductsController;
@endphp

@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Admins/Sub-Admin</a> <a href="#" class="current">List</a> </div>
  </div>
  @if(Session::has('flash_message_success'))  
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ session::get('flash_message_success') }}</strong>
    </div>
  @endif 
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Admins/Sub-Admins</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Access</th>
                  <th>Status</th>
                  <th>Created on</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($admins as $admin)
               <tr class="gradeX">
                  <td style="text-align: center;">{{ $admin->id }}</td>
                  <td style="text-align: center;">{{ $admin->username}}</td>
                  <td style="text-align: center;">{{ $admin->type}}</td>

                  <?php
                    if($admin->type == 'Admin')
                    {
                      $access = 'All';
                    }else{
                      $access = '';
                      if($admin->categories_access == 1)
                      {
                        $access .= 'Category';
                      }
                      if($admin->products_access == 1)
                      {
                        $access .= ',Products';
                      }
                      if($admin->orders_access == 1)
                      {
                        $access .= ',Orders';
                      }
                      if($admin->users_access == 1)
                      {
                        $access .= ',Users';
                      }
                    }
                  ?>
                  <td>{{ $access }}</td>
                  <td style="text-align: center;">
                     @if($admin->status == 1)
                        <span class="badge badge-success">Active</span>
                     @else
                        <span class="badge badge-danger">In-active</span>
                     @endif
                  </td>
                  <td style="text-align: center;">{{$admin->created_at->format('d-m-Y')}}</td>
                  <td>
                    @if($admin->type == 'Sub-Admin')
                    <a href="{{url('/admin/edit-admin/'.$admin->id)}}" class="btn btn-primary btn-mini" >Edit</a>
                    @endif
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

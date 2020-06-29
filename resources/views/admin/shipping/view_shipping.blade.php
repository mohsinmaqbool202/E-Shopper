@extends('layouts.adminLayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Shipping Charges</a> <a href="#" class="current">List</a> </div>
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
            <h5>Shipping Charges List</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Country Name</th>
                  <th>0g to 500g</th>
                  <th>501g to 1000g</th>
                  <th>1001g to 2000g</th>
                  <th>2001g to 5000g</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($shipping_charges as $charge)
                <tr class="gradeX">
                  <td>{{ $charge->id }}</td>
                  <td>{{ $charge->country->name }}</td>
                  <td>{{ $charge->shipping_charges0_500g }}</td>
                  <td>{{ $charge->shipping_charges501_1000g }}</td>
                  <td>{{ $charge->shipping_charges1001_2000g }}</td>
                  <td>{{ $charge->shipping_charges2001_5000g }}</td>
                  <td class="center">
                    <a href="{{ url('/admin/edit-shipping', $charge->id) }}" class="btn btn-primary btn-mini">Edit</a>
                    <a rel="{{ $charge->id }}" rel1="delete-shipping" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
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

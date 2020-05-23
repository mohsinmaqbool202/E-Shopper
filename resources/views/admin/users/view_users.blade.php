@php
use \App\Http\Controllers\ProductsController;
@endphp

@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Users</a> <a href="#" class="current">List</a> </div>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Users</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>User ID</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Country</th>
                  <th>Pincode</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Registered on</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($users as $user)
               <tr class="gradeX">
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name}}</td>
                  <td>{{ $user->address }}</td>
                  <td>{{ $user->city }}</td>
                  <td>{{ $user->state }}</td>
                  <td>{{ $user->country->name }}</td>
                  <td>{{ $user->pincode }}</td>
                  <td>{{ $user->mobile }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                     @if($user->status == 1)
                        <span class="badge badge-success">Active</span>
                     @else
                        <span class="badge badge-danger">In-active</span>
                     @endif
                  </td>
                  <td>{{ $user->created_at->format('d-m-Y') }}</td>
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

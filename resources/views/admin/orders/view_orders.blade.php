@php
use \App\Http\Controllers\ProductsController;
@endphp

@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Orders</a> <a href="#" class="current">List</a> </div>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Orders</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Order Date</th>
                  <th>Customer Name</th>
                  <th>Customer Email</th>
                  <th>Ordered Products</th>
                  <th>Order Amount</th>
                  <th>Order Status</th>
                  <th>Payment Method</th>
                  <th width="15%"></th>
                </tr>
              </thead>
              <tbody>
              	@foreach($orders as $order)
               <tr class="gradeX">
                  <td>{{ $order->id }}</td>
                  <td>{{ $order->created_at->format('Y-m-d') }}</td>
                  <td>{{ $order->user->name }}</td>
                  <td>{{ $order->user->email }}</td>
                  <td>
                      @foreach($order->orders as $pro)
                         <a href="#">{{$pro->cart->product_code}} ({{$pro->cart->quantity}})</a><br>
                      @endforeach
                  </td>
                  <td>{{$order->grand_total}}</td>
                  <td>{{ ProductsController::orderStatus($order->id) }}</td>
                  <td>{{$order->payment_method}}</td>
                  <td>
                    <a href="{{ url('/admin/view-order/'.$order->id) }}" class="btn btn-success btn-mini" title="View Detail">View Detail</a> 
                    <a href="{{ url('/admin/view-order-invoice/'.$order->id) }}" class="btn btn-primary btn-mini" title="View Detail">View Invoice</a> 
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

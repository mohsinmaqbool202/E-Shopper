@php
use \App\Http\Controllers\ProductsController;
@endphp

@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
     <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Order</a> <a href="#" class="current">{{$orderDetail->id}}</a> </div>
  </div>
  <div class="container-fluid">
  	<h3>Order # {{$orderDetail->id}}</h3>
  	<hr>
    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title">
            <h5>Order Detail</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered">
              <tbody>
                <tr>
                  <td class="taskDesc"> Order Date</td>
                  <td class="taskStatus">{{ $orderDetail->created_at->format('Y-m-d') }}</td>
                </tr>
                <tr>
                  <td class="taskDesc"> Order Status</td>
                  <td class="taskStatus">{{ ProductsController::orderStatus($orderDetail->id) }}</td>
                </tr>
                <tr>
                  <td class="taskDesc"> Order Total</td>
                  <td class="taskStatus">PKR:{{ $orderDetail->grand_total }}</td>
                </tr>
                <tr>
                  <td class="taskDesc">Shipping Charges</td>
                  <td class="taskStatus">PKR:{{ $orderDetail->shipping_charges }}</td>
                </tr>
                <tr>
                  <td class="taskDesc">Coupon Code</td>
                  <td class="taskStatus">{{ $orderDetail->coupon_code }}</td>
                </tr>
                <tr>
                  <td class="taskDesc">Coupon Amount</td>
                  <td class="taskStatus">PKR:@if ($orderDetail->coupon_amount == null) 0 @else {{$orderDetail->coupon_amount}} @endif</td>
                </tr>
                <tr>
                  <td class="taskDesc">Payment Method</td>
                  <td class="taskStatus">{{ $orderDetail->payment_method }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="widget-box">
          <div class="widget-title">
            <h5>Billing Address</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered">
              <tbody>
                <tr>
                  <td class="taskDesc">Address</td>
                  <td class="taskStatus">{{ $orderDetail->user->address }}</td>
                </tr>
                <tr>
                  <td class="taskDesc"> City</td>
                  <td class="taskStatus">{{ $orderDetail->user->city  }}</td>
                </tr>
                <tr>
                  <td class="taskDesc"> State</td>
                  <td class="taskStatus">{{ $orderDetail->user->state  }}</td>
                </tr>
                <tr>
                  <td class="taskDesc"> Country</td>
                  <td class="taskStatus">{{ $orderDetail->user->country->name  }}</td>
                </tr>
                <tr>
                  <td class="taskDesc"> PinCode</td>
                  <td class="taskStatus">{{ $orderDetail->user->pincode  }}</td>
                </tr>
                 <tr>
                  <td class="taskDesc"> Mob#</td>
                  <td class="taskStatus">{{ $orderDetail->user->mobile  }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title">
            <h5>Customer Detail</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered">
              <tbody>
                <tr>
                  <td class="taskDesc"> Customer Name</td>
                  <td class="taskStatus">{{ $orderDetail->user->name }}</td>
                </tr>
                <tr>
                  <td class="taskDesc"> Customer Detail</td>
                  <td class="taskStatus">{{ $orderDetail->user->email }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        @if(Session::has('flash_message_success'))  
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session::get('flash_message_success') }}</strong>
        </div>
        @endif 
        <div class="accordion" id="collapse-group">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title">
                <h5>Update Order Status</h5>
              </div>
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
              <div class="widget-content">
              	<form method="post" action="{{ url('admin/update-order-status') }}">
              		 {{csrf_field()}}
              		 <input type="hidden" name="order_id" value="{{ $orderDetail->id }}">
              		<table width="500%">
              			<tr>
              				<td>
												<select name="order_status" id="order_status" required>
													<option value="0" @if($orderDetail->order_status == 0) selected @endif>New</option>
													<option value="1" @if($orderDetail->order_status == 1) selected @endif>Pending</option>
													<option value="2" @if($orderDetail->order_status == 2) selected @endif>Cancelled</option>
													<option value="3" @if($orderDetail->order_status == 3) selected @endif>Shipped</option>
													<option value="4" @if($orderDetail->order_status == 4) selected @endif>Delivered</option>
												</select> 
											</td>
											<td>
					              <input type="submit" value="Update Status" class="btn btn-success">
					            </td>
					          </tr>      
			            </table>    
	              </form>
              </div>
            </div>
          </div>
        </div>
        <div class="widget-box">
          <div class="widget-title">
            <h5>Shipping Address</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered">
              <tbody>
                <tr>
                  <td class="taskDesc">Address</td>
                  <td class="taskStatus">{{ $orderDetail->user->deliveryAddress->address }}</td>
                </tr>
                <tr>
                  <td class="taskDesc"> City</td>
                  <td class="taskStatus">{{ $orderDetail->user->deliveryAddress->city  }}</td>
                </tr>
                <tr>
                  <td class="taskDesc"> State</td>
                  <td class="taskStatus">{{ $orderDetail->user->deliveryAddress->state  }}</td>
                </tr>
                <tr>
                  <td class="taskDesc"> Country</td>
                  <td class="taskStatus">{{ $orderDetail->user->deliveryAddress->country->name  }}</td>
                </tr>
                <tr>
                  <td class="taskDesc"> PinCode</td>
                  <td class="taskStatus">{{ $orderDetail->user->deliveryAddress->pincode  }}</td>
                </tr>
                 <tr>
                  <td class="taskDesc"> Mob#</td>
                  <td class="taskStatus">{{ $orderDetail->user->deliveryAddress->mobile  }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
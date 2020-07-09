<?php
use Milon\Barcode\DNS1D;
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">
             Order # {{$orderDetail->id}}
            <span style="float: right; margin-left: 6px;"><?php  echo DNS1D::getBarcodeHTML($orderDetail->id, 'C39'); ?></span>
           </h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					{{ $orderDetail->user->name}}<br>
    					{{ $orderDetail->user->address }}<br>
    				  {{ $orderDetail->user->city }}<br>
    					{{ $orderDetail->user->state }}<br>
    					{{ $orderDetail->user->country->name }}<br>
    					{{ $orderDetail->user->pincode  }}<br>
    					{{ $orderDetail->user->mobile  }}<br>

    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
    					{{ $orderDetail->user->deliveryAddress->name }}<br>
    					{{ $orderDetail->user->deliveryAddress->address }}<br>
    					{{ $orderDetail->user->deliveryAddress->city }}<br>
    					{{ $orderDetail->user->deliveryAddress->state }}<br>
    					{{ $orderDetail->user->deliveryAddress->country->name }}<br>
    					{{ $orderDetail->user->deliveryAddress->pincode }}<br>
    					{{ $orderDetail->user->deliveryAddress->mobile }}<br>
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					{{ $orderDetail->payment_method }}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					{{ $orderDetail->created_at->format('M d, Y') }}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                  <tr>
      							<td class="text-left"><strong>Code</strong></td>
      							<td class="text-center"><strong>Name</strong></td>
      							<td class="text-center"><strong>Size</strong></td>
      							<td class="text-center"><strong>Color</strong></td>
      							<td width="5%" class="text-center"><strong>Quantity</strong></td>
      							<td class="text-center"><strong>Price</strong></td>
      							<td class="text-right"><strong>Totals</strong></td>
                   </tr>
    						</thead>
    						<tbody>
    							@php
    							 $sub_total = 0;
    							@endphp
    							@foreach($orderDetail->orders as $pro)
                  <tr>
            				<td class="text-left">{{$pro->cart->product_code}}</td>
    								<td class="text-center">{{$pro->cart->product_name}}</td>
    								<td class="text-center">{{$pro->cart->size}}</td>
    								<td class="text-center">{{$pro->cart->product_color}}</td>
    								<td class="text-center">{{$pro->cart->quantity}}</td>
    								<td class="text-center">PKR:{{$pro->cart->product_price}}</td>
    								<td class="text-right">PKR:{{$pro->cart->product_price * $pro->cart->quantity}}</td>
    							</tr>
    							 @php
    							 $sub_total += $pro->cart->product_price * $pro->cart->quantity;
    							 @endphp
    							@endforeach
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">PKR:{{$sub_total}}</td>
    							</tr>
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="no-line text-center"><strong>Shipping Charges(+)</strong></td>
    								<td class="no-line text-right">PKR:{{ $orderDetail->shipping_charges }}</td>
    							</tr>
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="no-line text-center"><strong>Coupon Discount(-)</strong></td>
    								<td class="no-line text-right">PKR:{{ $orderDetail->coupon_amount }}</td>
    							</tr>
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">PKR:{{ $orderDetail->grand_total }}</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
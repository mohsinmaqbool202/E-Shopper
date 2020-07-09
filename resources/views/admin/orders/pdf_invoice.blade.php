<?php
use Milon\Barcode\DNS1D;
?>

<!DOCTYPE html>
<html>
<head>
  <title>Invoice # {{$orderDetail->id}}</title>
  <style>
    .floatLeft { width: 50%; float: left; }
    .floatRight {width: 50%; float: right; }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="invoice-title">
            <h2>Invoice</h2><h3>Order # <span ><?php  echo DNS1D::getBarcodeHTML($orderDetail->id, 'C39'); ?></span></h3>
        </div>
        <hr>
        <div class="row">
          <div class="floatLeft">
            <strong>Billed To:</strong><br>
             <table>
              <tr>
                <td>{{ $orderDetail->user->name}}</td>
              </tr>
              <tr>
                <td>{{ $orderDetail->user->address }}</td>
              </tr>
              <tr>  
                <td>{{ $orderDetail->user->city }}</td>
              </tr>
              <tr>
                <td>{{ $orderDetail->user->state }}</td>
              </tr>
              <tr>  
                <td>{{ $orderDetail->user->country->name }}</td>
              </tr>
              <tr>
                <td>{{ $orderDetail->user->pincode  }}</td>
              </tr>
              <tr>  
                <td>{{ $orderDetail->user->mobile  }}</td>
              </tr>  
              </tr>
              </table>
          </div>
          <div class="floatRight">
            <strong>Shipped To:</strong><br>
              <table>
              <tr>
                <td>{{ $orderDetail->user->deliveryAddress->name }}</td>
              </tr>
              <tr>
                <td>{{ $orderDetail->user->deliveryAddress->address }}</td>
              </tr>
              <tr>  
                <td>{{ $orderDetail->user->deliveryAddress->city }}</td>
              </tr>
              <tr>
                <td>{{ $orderDetail->user->deliveryAddress->state }}</td>
              </tr>
              <tr>  
                <td>{{ $orderDetail->user->deliveryAddress->country->name }}</td>
              </tr>
              <tr>
                <td>{{ $orderDetail->user->deliveryAddress->pincode }}</td>
              </tr>
              <tr>  
                <td>{{ $orderDetail->user->deliveryAddress->mobile }}</td>
              </tr>  
              </tr>
              </table>
          </div>
        </div>
        <div class="row">
            <div style="width: 50%;">
              <strong>Payment Method:</strong><br>
              {{ $orderDetail->payment_method }}
            </div>
            <div style="float: right; width: 50%; margin-top: -40px;">
                <strong>Order Date:</strong><br>
                {{ $orderDetail->created_at->format('M d, Y') }}<br><br>
            </div>
        </div>
      </div>
    </div>
    
    <div class="row" style="margin-top: 40px;">
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
</body>
</html>
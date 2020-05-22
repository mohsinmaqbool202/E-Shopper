<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
  <table width="700px" border="0" cellpadding="0" cellspacing="0">
  	<tr><td>&nbsp;</td></tr>
  	<tr><td><img src="{{ asset('images/frontend_images/home/logo.png') }}"></td></tr>
  	<tr><td>&nbsp;</td></tr>
  	<tr><td>Hello {{ $name }},</td></tr>
  	<tr><td>&nbsp;</td></tr>
  	<tr><td>Thank you for shopping with us, your order details are as below:-</td></tr>
  	<tr><td>&nbsp;</td></tr>
  	<tr><td>Order NO: {{ $order_id }}</td></tr>
  	<tr><td>&nbsp;</td></tr>
  	<tr><td>
  			<table width="95%" cellpadding="5" cellspacing="5" bgcolor="#f7f4f4">
  				<tr bgcolor="#cccccc">
  					<td>Product Name</td>
  					<td>Product Code</td>
  					<td>Size</td>
  					<td>Color</td>
  					<td>Quantity</td>
  					<td>Unit Price</td>
  				</tr>
  				@foreach($orderDetail->orders as $product)
  				<tr>
  					<td>{{ $product->cart->product_name }}</td>
  					<td>{{ $product->cart->product_code }}</td>
  					<td>{{ $product->cart->size }}</td>
  					<td>{{ $product->cart->product_color }}</td>
  					<td>{{ $product->cart->quantity }}</td>
  					<td>{{ $product->cart->product_price }}</td>
  				</tr>
  				@endforeach
  				<tr>
  					<td colspan="5" align="right">Shipping Charges</td>
  					<td>PKR:{{ $orderDetail->shipping_charges }}</td>
  				</tr>
  				<tr>
  					<td colspan="5" align="right">Coupon Discont</td>
  					<td>PKR:{{ $orderDetail->coupon_amount }}</td>
  				</tr><tr>
  					<td colspan="5" align="right">Grand Total</td>
  					<td>PKR:{{ $orderDetail->grand_total }}</td>
  				</tr>
  			</table>
  	</td></tr>
  	<tr><td>
  		<table width="100%">
				<tr>
					<td width="50%">
						<table>
							 <tr>
							 	<td><strong>Bill To</strong></td>
							 </tr>
							 <tr>
							 	<td>{{ $user->name }}</td>
							 </tr>
							 <tr>
							 	<td>{{ $user->address }}</td>
							 </tr>
							 <tr>
							 	<td>{{ $user->city }}</td>
							 </tr>
							 <tr>
							 	<td>{{ $user->state }}</td>
							 </tr>
							 <tr>
							 	<td>{{ $user->country->name }}</td>
							 </tr>
							 <tr>
							 	<td>{{ $user->pincode }}</td>
							 </tr>
							 <tr>
							 	<td>{{ $user->mobile }}</td>
							 </tr>
						</table>
					</td>
					<td width="50%">
						<table>
							 <tr>
							 	<td><strong>Ship To</strong></td>
							 </tr>
							 <tr>
							 	<td>{{ $user->deliveryAddress->name }}</td>
							 </tr>
							 <tr>
							 	<td>{{ $user->deliveryAddress->address }}</td>
							 </tr>
							 <tr>
							 	<td>{{ $user->deliveryAddress->city }}</td>
							 </tr>
							 <tr>
							 	<td>{{ $user->deliveryAddress->state }}</td>
							 </tr>
							 <tr>
							 	<td>{{ $user->deliveryAddress->country->name }}</td>
							 </tr>
							 <tr>
							 	<td>{{ $user->deliveryAddress->pincode }}</td>
							 </tr>
							 <tr>
							 	<td>{{ $user->deliveryAddress->mobile }}</td>
							 </tr>
						</table>
					</td>
				</tr>  			
  		</table>
  	</td></tr>
  	<tr><td>&nbsp;</td></tr>
  	<tr><td>For any query you contact us at <a href="mailto:mohsinmaqbool451@gmail.com">mohsinmaqbool451@gmail.com</a></td></tr>
  	<tr><td>&nbsp;</td></tr>
  	<tr><td>Regards: Team E-Sop</td></tr>
  	<tr><td>&nbsp;</td></tr>
  </table>
</body>
</html>
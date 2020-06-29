<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShippingCharge;
use App\Country;;

class ShippingController extends Controller
{
	public function addShipping(Request $request)
	{
		if($request->isMethod('post'))
		{
			ShippingCharge::create($request->all());
			return redirect('/admin/view-shipping')->with('flash_message_success','Shipping Charges added!');
		}

		//get request
		$countries = Country::all();
		return view('admin.shipping.add_shipping', compact('countries'));
	}

    public function viewShipping()
    {

    	$shipping_charges = ShippingCharge::all();
    	return view('admin.shipping.view_shipping',compact('shipping_charges'));
    }

  	public function editShipping(Request $request, $id)
  	{
  		if($request->isMethod('post'))
  		{
  			$shipping = ShippingCharge::find($id);
   			$shipping->country_id = $request->country_id;
  			$shipping->shipping_charges0_500g     = $request->shipping_charges0_500g;
        $shipping->shipping_charges501_1000g  = $request->shipping_charges501_1000g;
        $shipping->shipping_charges1001_2000g = $request->shipping_charges1001_2000g;
        $shipping->shipping_charges2001_5000g = $request->shipping_charges2001_5000g;
  			$shipping->save();
			return redirect('/admin/view-shipping')->with('flash_message_success','Shipping Charges updated!');

  		}

  		//get request
  		$shipping = ShippingCharge::find($id);
		$countries = Country::all();
		return view('admin.shipping.edit_shipping', compact('countries','shipping'));
  	}

    public function deleteShipping($id)
    {
    	ShippingCharge::where('id',$id)->delete();
		return redirect('/admin/view-shipping')->with('flash_message_success','Shipping Charges Deleted!');
    }
}

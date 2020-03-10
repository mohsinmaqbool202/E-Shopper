<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;

class CouponsController extends Controller
{
    public function addCoupon(Request $request)
    {
    	if($request->isMethod('post')){

    		if($request->status == '')
    		{
    			$request["status"] = 0;
    		}
    		
    		Coupon::create($request->all());
    		return back()->with('flash_message_success', 'Coupon has been added.');
    	}
    	return view('admin.coupons.add_coupon');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;

class CouponsController extends Controller
{
    //save coupan
    public function addCoupon(Request $request)
    {
    	if($request->isMethod('post')){

  		if($request->status == '')
  		{
  			$request["status"] = 0;
  		}
  		Coupon::create($request->all());
  		return redirect('/admin/view-coupons')->with('flash_message_success', 'Coupon has been added.');
    	}
    	return view('admin.coupons.add_coupon');
    }

    //view all coupans
    public function viewCoupons()
    {
      $coupons = Coupon::all();
      return view('admin.coupons.view_coupons', compact('coupons'));
    }

    //Edit Coupon
    public function editCoupon(Request $request, $id)
    {
      if($request->isMethod('post'))
      {
        if($request->status == '')
        {
          $request["status"] = 0;
        }

        $coupon = Coupon::find($id);
        $coupon->coupon_code = $request->coupon_code;
        $coupon->amount = $request->amount;
        $coupon->amount_type = $request->amount_type;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->status = $request->status;
        $coupon->save();
        
        return redirect('/admin/view-coupons')->with('flash_message_success', 'Coupon has been updated.');
      }

      $coupon = Coupon::find($id);
      return view('admin.coupons.edit_coupon', compact('coupon'));
    }

    public function deleteCoupon($id)
    {
      Coupon::where('id', $id)->delete();
      return redirect('/admin/view-coupons')->with('flash_message_success', 'Coupon has been deleted.');
    }

}

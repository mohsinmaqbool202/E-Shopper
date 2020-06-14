<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;

class CurrencyController extends Controller
{
    public function addCurrency(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    	   $data = $request->all();
    	   if(empty($data['status']))
    	   {
    	   	 $data['status'] = 0;
    	   }
    	   else{
    	   	 $data['status'] = 1;
    	   }

    	   Currency::create($data);
    	   return redirect('/admin/view-currencies')->with('flash_message_success', 'Currency has been added.');
    	}

    	//get reqyest
    	return view('admin.currencies.add_currency');
    }

    public function viewCurrencies()
    {
    	$currencies = Currency::all();
    	return view('admin.currencies.view_currencies', compact('currencies'));
    }

    public function editCurrency(Request $request, $id)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->all();
    		if(empty($data['status']))
    	    {
    	   	 $data['status'] = 0;
    	    }
    	    else{
    	   	 $data['status'] = 1;
    	    }

    	    $currency = Currency::find($id);
    	    $currency->currency_code = $data['currency_code'];
    	    $currency->exchange_rate = $data['exchange_rate'];
    	    $currency->status = $data['status'];
    	    $currency->save();

    	   return redirect('/admin/view-currencies')->with('flash_message_success', 'Currency has been updated.');

    	}

    	//get request
    	$currency = Currency::find($id);
    	return view('admin.currencies.edit_currency', compact('currency'));
    }

    public function deleteCurrency($id)
    {
    	$currency = Currency::find($id);
    	$currency->delete();
    	return redirect('/admin/view-currencies')->with('flash_message_success', 'Currency has been updated.');
    }
}

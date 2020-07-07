<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsletterSubscriber;
use Maatwebsite\Excel\Facades\Excel;

class NewsletterController extends Controller
{
    public function addSubscriber(Request $request)
    {
    	$this->validate($request, [
    		'email' => 'required',
    	]);

    	$countMail = NewsletterSubscriber::where('email', $request->email)->count();
    	if($countMail > 0){
	    	$notification = array(
	    		'message'    => 'Sorry, this email already exists!',
	    		'alert type' => 'error'
	    	);
	        return back()->with($notification);	
    	}

    	//insert data
    	NewsletterSubscriber::create($request->all());

    	$notification = array(
    		'message'    => 'You have subscribed successfully!',
    		'alert type' => 'success'
    	);
	    return back()->with($notification);	
    }

    public function viewSubscribers()
    {
    	$subscribers = NewsletterSubscriber::orderBy('id','desc')->get();
    	return view('admin.subscribers.list' , compact('subscribers'));
    }

    public function updateSubscriberStatus($id, $status)
    {
    	NewsletterSubscriber::where('id', $id)->update(['status' => $status]);
    	return back()->with('flash_message_success','Status Updated!');
    }

    public function deleteSubscriber($id)
    {
    	$subsCount = NewsletterSubscriber::where('id', $id)->count();
    	if(!$subsCount)
    	{
    		abort(404);
    	}

    	NewsletterSubscriber::where('id', $id)->delete();
    	return back()->with('flash_message_success','Subscriber Deleted!');
    }

    public function exportSubscribersEmails()
    {
    	$subscribersData = NewsletterSubscriber::select('id', 'email','created_at')->where('status',1)->orderBy('id','Desc')->get();
    	
    	return Excel::create('Subscribers'.rand(), function($excel) use($subscribersData){
    		$excel->sheet('mySheet',function($sheet) use($subscribersData){
    			$sheet->fromArray($subscribersData);
    		});
    	})->download('xlsx');
    }
}

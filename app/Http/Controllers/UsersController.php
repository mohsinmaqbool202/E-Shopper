<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function register(Request $request)
    {
    	if($request->isMEthod('post'))
    	{
    		$userCount = User::where('email', $request->email)->count();
    		if($userCount > 0){
    			return redirect()->back()->with('flash_message_error', 'Email Already Exists.');
    		}
            else{
                dd(1);
            }
    	}

        //for get request
    	return view('users.login_register');
    }

    //check if user already exist or not
    public function checkEmail(Request $request)
    {
       $userCount = User::where('email', $request->email)->count();
        if($userCount > 0){
            return "false";
        }
        else{
            return "true";
        }
    }
}

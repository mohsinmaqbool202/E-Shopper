<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;

class UsersController extends Controller
{
    public function userLoginRegister()
    {
        return view('users.login_register');
    }

    //Register New User
    public function register(Request $request)
    {
      $data = $request->all();
    	if($request->isMethod('post'))
    	{
    		$userCount = User::where('email', $request->email)->count();
    		if($userCount > 0){
    			return redirect()->back()->with('flash_message_error', 'Email Already Exists.');
    		}
        else{
            //create new user
            $request["password"] = bcrypt($request->password);
            $request["admin"]    = '0';
            User::create($request->all());
            
            //redirect the user to cart page after registering
            if(Auth::attempt(['email'=>$data['email'],'password' => $data['password'], 'admin' => '0']))
            {
              Session::put('frontSession', $data["email"]); 
              return redirect('/cart');
            }
        }
    	}
    }

    //User login function
    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
             if(Auth::attempt(['email'=>$data['email'],'password' => $data['password'], 'admin' => '0'])){

               Session::put('frontSession', $data["email"]); 
               return redirect('/cart');
            }
            else{
                return back()->with('flash_message_error', 'Invalid Username or Password!');
            }

        }
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

    //user account function
    public function account(Request $request)
    {
        return view('users.account');
    }

    //User Logout function
    public function userlogout()
    {
      Auth::logout();
      Session::forget('frontSession');
      return redirect('/');
    }
}

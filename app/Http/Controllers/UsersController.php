<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Country;
use Illuminate\Support\Facades\Hash;


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
        if($request->isMethod('post'))
        {
            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->country_id = $request->country_id;
            $user->pincode = $request->pincode;
            $user->mobile = $request->mobile;

            $user->save();
            return back()->with('flash_message_success', 'Account Info Updated.');
        }

        //for get request
        $user = Auth::user();
        $countries = Country::all();
        return view('users.account', compact('countries', 'user'));
    }

    //for checking user current pwd
    public function checkUserPwd(Request $request)
    {
        $data = $request->all();
        $current_password = $data['current_pwd'];

        $user = Auth::user();
        if(Hash::check($current_password , $user->password))
        {
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }

    //update user pwd
    public function updatePassword(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
    
        if(Hash::check($data['current_pwd'] , $user->password))
        {
            $password = bcrypt($data['new_pwd']);
            $user->password = $password;
            $user->save();
            return redirect('/account')->with('flash_message_success', 'Password has been updated.');
        }
        else{
            return redirect('/account')->with('flash_message_error', 'Current Password is Incorrect.');
        }
    }

    //User Logout function
    public function userlogout()
    {
      Auth::logout();
      Session::forget('frontSession');
      return redirect('/');
    }
}

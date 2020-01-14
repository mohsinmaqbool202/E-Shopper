<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->input();

    		if(Auth::attempt(['email'=>$data['email'], 'password' => $data['password'], 'admin' => '1' ])){
    			
                return redirect('/admin/dashboard');
    		}
    		else
            {
                return redirect('/admin')->with('flash_message_error', 'Invalid Username or Password.');
    		}
    	}
    	else
    	{
    	 return view('admin.admin_login');
    	}
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function checkPassword(Request $request)
    {
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $user = User::where('admin', '1')->first();
        if(Hash::check($current_password , $user->password))
        {
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function updatePassword(Request $request)
    {
       if($request->isMethod('post'))
       {
        $data = $request->all();
        $check_pwd = User::where('email', Auth::user()->email)->pluck('password');
        $current_pwd = $data['current_pwd'];
            if(Hash::check($current_pwd , $check_pwd[0]))
            {
                $password = bcrypt($data['new_pwd']);
                User::where('email', Auth::user()->email)->update(['password' => $password]);
                return redirect('/admin/settings')->with('flash_message_success', "Password Updated Successfully.");
            }
            else{
                
                return redirect('/admin/settings')->with('flash_message_error', "Incorrect Current Password.");
            }

       }
    }

     public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('flash_message_success', 'Logged Out Successfully.');
    }
}

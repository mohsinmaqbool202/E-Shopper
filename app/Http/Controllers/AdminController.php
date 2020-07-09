<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Order;

class AdminController extends Controller
{
    public function login(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->input();
            $adminCount = Admin::where(['username'=> $data['username'], 'password'=> md5($data['password']), 'status'=>1 ])->count();
            
    		if($adminCount > 0){
    			
                Session::put('adminSession', $data['username']);
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
      $adminCount = Admin::where(['username'=> Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
      if($adminCount == 1)
      {
          echo "true"; die;
      }else{
          echo "false"; die;
      }
    }

    public function settings()
    {
        $adminDetail = Admin::where('username', Session::get('adminSession'))->first();
        return view('admin.settings', compact('adminDetail'));
    }

    public function updatePassword(Request $request)
    {
       if($request->isMethod('post'))
       {
        $data = $request->all();
        
        $adminCount = Admin::where(['username'=> Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();

            if($adminCount == 1)
           {
                $password = md5($data['new_pwd']);
                Admin::where('username', Session::get('adminSession'))->update(['password' => $password]);
                return redirect('/admin/settings')->with('flash_message_success', "Password Updated Successfully.");
            }
            else{
                
                return redirect('/admin/settings')->with('flash_message_error', "Current Password is not Correct.");
            }

       }
    }

     public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('flash_message_success', 'Logged Out Successfully.');
    }

    public function viewAdmins()
    {
      $admins = Admin::all();
      return view('admin.admins.view_admins', compact('admins'));
    }

    public function addAdmin(Request $request)
    {
      if($request->isMethod('post'))
      {
        $data = $request->all();
        $adminCount = Admin::where('username', $data['username'])->count();
        if($adminCount > 0){
          return redirect()->back()->with('flash_message_error', 'Username already exist.Please choose another username!');
        }
        else{
          if($data['type'] == 'Admin'){
            $data['type']              = $data['type'];
            $data['password']          = md5($data['password']);
            $data['categories_view_access'] = 1;
            $data['categories_edit_access'] = 1;
            $data['categories_full_access'] = 1;
            $data['products_access']        = 1;
            $data['orders_access']          = 1;
            $data['users_access']           = 1;
            Admin::create($data);
            return redirect('/admin/view-admins')->with('flash_message_success', 'New Admin Added.');
          }
          elseif($data['type'] == 'Sub-Admin')
          {
            $data['type']              = $data['type'];
            $data['password']          = md5($data['password']);
            Admin::create($data);
            return redirect('/admin/view-admins')->with('flash_message_success', 'New Sub-Admin Added.');
          }  
        }
      }

      //get request
      return view('admin.admins.add_admin');
    }

    public function editAdmin(Request $request, $id)
    {
      if($request->isMethod('post')){
        $data = $request->all();
        if($data['type'] == 'Sub-Admin'){
          
          if(empty($data['categories_access'])){
            $data['categories_access'] = 0;
          }
          if(empty($data['products_access'])){
            $data['products_access'] = 0;
          }
          if(empty($data['orders_access'])){
            $data['orders_access'] = 0;
          }
          if(empty($data['users_access'])){
            $data['users_access'] = 0;
          }
          if(empty($data['status'])){
            $data['status'] = 0;
          }
          $sub_admin = Admin::find($id);
          $sub_admin->categories_access = $data['categories_access'];
          $sub_admin->products_access   = $data['products_access'];
          $sub_admin->orders_access     = $data['orders_access'];
          $sub_admin->users_access      = $data['users_access'];
          $sub_admin->status            = $data['status'];
          $sub_admin->save();
          return redirect('/admin/view-admins')->with('flash_message_success', 'Sub-Admin Updated Added.');
        }
      }
      $admin = Admin::find($id);
      return view('admin.admins.edit_admin', compact('admin'));
    }


    public function charts()
    {
      for($i = 12; $i>=1; $i--)
        {
          if($i == 12){
              $date = Carbon::now();
              $months[$i] = $date->format('n');
              $years[$i] = $date->format('Y');
              $month_year[$i] = $date->format('Y-M');

              //month wise students
              $users[$i] = User::whereMonth('created_at',$months[$i])->whereYear('created_at',$years[$i])->count();

              //month wise orders
              $orders[$i] = Order::whereMonth('created_at',$months[$i])->whereYear('created_at',$years[$i])->count();

              //delivered orders
              $orders_delivered[$i] = Order::where('order_status',4)->whereMonth('created_at',$months[$i])->whereYear('created_at',$years[$i])->count(); 

              //cancelled orders
              $orders_cancelled[$i] = Order::where('order_status',4)->whereMonth('created_at',$months[$i])->whereYear('created_at',$years[$i])->count();
              
          }
          else
          {
            $date = $date->subMonth();
            $months[$i] = $date->format('n');
            $years[$i] = $date->format('Y');
            $month_year[$i] = $date->format('Y-M');

            //month wise students
            $users[$i] = User::whereMonth('created_at',$months[$i])->whereYear('created_at',$years[$i])->count();

            //month wise orders
            $orders[$i] = Order::whereMonth('created_at',$months[$i])->whereYear('created_at',$years[$i])->count();

            //delivered orders
            $orders_delivered[$i] = Order::where('order_status',4)->whereMonth('created_at',$months[$i])->whereYear('created_at',$years[$i])->count();

            //cancelled orders
            $orders_cancelled[$i] = Order::where('order_status',4)->whereMonth('created_at',$months[$i])->whereYear('created_at',$years[$i])->count();  
             
          }
        }

      $output['users']             = $users;
      $output['orders']            = $orders;
      $output['orders_delivered']  = $orders_delivered;
      $output['orders_cancelled']  = $orders_cancelled;
      $output['month_year']        = $month_year;

      return $output;
    }
}

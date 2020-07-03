<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Closure;
use Session;
use App\Admin;

class adminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(empty(Session::has('adminSession')))
        {   
            return redirect('/admin');
        }
        else
        {
            $admin_info = Admin::where('username',Session::get('adminSession'))->first();
            Session::put('admin_info',$admin_info);

            //get current path
            $currentPath = Route::getFacadeRoot()->current()->uri();
            
            if($currentPath == "admin/add-category"  && Session::get('admin_info')['categories_access'] == 0)
            {
                return redirect('admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            if($currentPath == "admin/view-category"  && Session::get('admin_info')['categories_access'] == 0)
            {
                return redirect('admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            if($currentPath == "admin/add-product"  && Session::get('admin_info')['products_access'] == 0)
            {
                return redirect('admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            if($currentPath == "admin/view-products"  && Session::get('admin_info')['products_access'] == 0)
            {
                return redirect('admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            if($currentPath == "admin/view-orders"  && Session::get('admin_info')['orders_access'] == 0)
            {
                return redirect('admin/dashboard')->with('flash_message_error','You have no access for this module');
            }
            if($currentPath == "admin/view-users"  && Session::get('admin_info')['users_access'] == 0)
            {
                return redirect('admin/dashboard')->with('flash_message_error','You have no access for this module');
            }

        }
        return $next($request);
    }
}

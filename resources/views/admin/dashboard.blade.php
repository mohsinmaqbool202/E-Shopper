@extends('layouts.adminLayout.admin_design')

@section('content')

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
<div class="container-fluid">
    @if(Session::has('flash_message_error'))  
      <div class="alert alert-danger alert-block">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong>{{ session::get('flash_message_error') }}</strong>
      </div>
    @endif 
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_lb"> <a href="{{url('/admin/dashboard')}}"> <i class="icon-dashboard"></i> <span class="label label-important"></span> My Dashboard </a> </li>
        <!-- <li class="bg_lg span3"> <a href="charts.html"> <i class="icon-signal"></i> Charts</a> </li> -->
        @if(Session::get('admin_info')['categories_access'] == 1)
        <li class="bg_ly"> <a href="{{url('/admin/view-category')}}"> <i class="icon-inbox"></i><span class="label label-success">101</span> Categories </a> </li>
        @endif
        @if(Session::get('admin_info')['products_access'] == 1)
        <li class="bg_lo"> <a href="{{url('/admin/view-products')}}"> <i class="icon-inbox"></i><span class="label label-success">101</span> Products </a> </li>
        @endif
        @if(Session::get('admin_info')['orders_access'] == 1)
        <li class="bg_ls"> <a href="{{url('/admin/view-orders')}}"> <i class="icon-inbox"></i><span class="label label-success">101</span> Orders </a> </li>
        @endif
        @if(Session::get('admin_info')['users_access'] == 1)
        <li class="bg_lb"> <a href="{{url('/admin/view-users')}}"> <i class="icon-inbox"></i><span class="label label-success">101</span> Users </a> </li>
        @endif
        @if(Session::get('admin_info')['type'] == 'Admin')
        <li class="bg_lr"> <a href="{{url('/admin/view-coupons')}}"> <i class="icon-inbox"></i><span class="label label-success">101</span> Coupons </a> </li>
        @endif
      </ul>
    </div>
<!--End-Action boxes-->    

<!--Chart-box-->    
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
          <h5>New Users</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span12">
              <canvas id="user_chart" style="width: 821px; height: 250px;"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
<!--End-Chart-box--> 
  </div>
</div>
<!--end-main-container-part-->

@endsection

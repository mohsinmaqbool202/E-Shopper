@extends('layouts.adminLayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Admins</a> <a href="#" class="current">Edit Admin</a> </div>
  </div>
  @if(Session::has('flash_message_error'))  
    <div class="alert alert-error alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ session::get('flash_message_error') }}</strong>
    </div>
  @endif 
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Admin Details</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-admin/'.$admin->id) }}" name="edit_admin" id="edit_admin" novalidate="novalidate">
              {{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Type</label>
                <div class="controls">
                  <input type="text" name="type" id="type" value="{{$admin->type}}" readonly>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">UserName</label>
                <div class="controls">
                  <input type="text" name="username" id="username" value="{{$admin->username}}" readonly>
                </div>
              </div>
              @if($admin->type == 'Sub-Admin')
                <div class="control-group">
                <label class="control-label">Access</label>
                <div class="controls">
                  <input type="checkbox" name="categories_access" id="categories_access" value="1" style="margin-top: -3px;" @if($admin->categories_access == 1)checked @endif>&nbsp;Category&nbsp;
                  <input type="checkbox" name="products_access"   id="products_access" value="1" style="margin-top: -3px;" @if($admin->products_access == 1)checked @endif >&nbsp;Products&nbsp;
                  <input type="checkbox" name="orders_access"     id="orders_access" value="1" style="margin-top: -3px;" @if($admin->orders_access == 1)checked @endif>&nbsp;Orders&nbsp;
                  <input type="checkbox" name="users_access"      id="users_access" value="1" style="margin-top: -3px;" @if($admin->users_access == 1)checked @endif>&nbsp;Users&nbsp;
                </div>
                </div>
              @endif
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" @if($admin->status == 1)checked value="1" @endif>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Admin" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

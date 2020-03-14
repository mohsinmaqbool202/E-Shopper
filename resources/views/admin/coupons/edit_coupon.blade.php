@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Coupon</a> <a href="#" class="current">Edit Coupon </a> </div>
    <h1>Add Coupon Here</h1>
  </div>
  @if(Session::has('flash_message_success'))  
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ session::get('flash_message_success') }}</strong>
    </div>
  @endif 
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Details</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-coupon/'.$coupon->id) }}" name="add_coupon" id="add_coupon">
              {{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Coupon Code</label>
                <div class="controls">
                  <input type="text" name="coupon_code" value="{{ $coupon->coupon_code }}" id="coupon_code" minlength="5" maxlength="15" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Amount</label>
                <div class="controls">
                  <input type="number" name="amount" value="{{ $coupon->amount }}" id="amount" min="0" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Amount Type</label>
                <div class="controls">
                 <select name="amount_type" id="amount_type" style="width: 220px;" required>
                  <option @if($coupon->amount_type == "percentage") selected @endif value="percentage">Percentage</option>
                  <option @if($coupon->amount_type == "fixed") selected @endif value="fixed">Fixed</option>
                 </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Expiry Date</label>
                <div class="controls">
                  <input type="text" name="expiry_date" value="{{ $coupon->expiry_date }}" id="expiry_date" autocomplete="off" required>
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1" @if($coupon->status == 1)checked @endif>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Coupon" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

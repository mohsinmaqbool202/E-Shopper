@extends('layouts.adminLayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Currencies</a> <a href="#" class="current">Edit Currency</a> </div>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Category Details</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-currency/'.$currency->id) }}" name="edit_currency" id="edit_currency" novalidate="novalidate">
              {{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Currency Code</label>
                <div class="controls">
                  <input type="text" name="currency_code" id="currency_code" value="{{$currency->currency_code}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Exchange Rate</label>
                <div class="controls">
                  <input type="text" name="exchange_rate" id="exchange_rate" value="{{$currency->exchange_rate}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" @if($currency->status ==1) checked value="1" @endif>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Edit Currency" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

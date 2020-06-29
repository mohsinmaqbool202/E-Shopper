@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Shipping Charges</a> <a href="#" class="current">Edit Shipping </a> </div>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Shipping Details</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/edit-shipping/'.$shipping->id) }}" name="edit_shipping" id="edit_shipping">
              {{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Select Country</label>
                <div class="controls">
                  <select name="country_id" style="width: 220px; " required>
                    <option >Select Country</option>
                    @foreach($countries as $country)
                     <option value="{{$country->id}}" @if($country->id == $shipping->country_id) selected @endif>{{$country->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Shipping Charges (0-500g)</label>
                <div class="controls">
                  <input type="text" name="shipping_charges0_500g" id="shipping_charges0_500g" value="{{ $shipping->shipping_charges0_500g }}" placeholder="Shipping Charges" required>
                </div>
              </div>  
              <div class="control-group">
                <label class="control-label">Shipping Charges (501-1000g)</label>
                <div class="controls">
                  <input type="text" name="shipping_charges501_1000g" id="shipping_charges501_1000g" value="{{ $shipping->shipping_charges501_1000g }}" placeholder="Shipping Charges" required>
                </div>
              </div>  
              <div class="control-group">
                <label class="control-label">Shipping Charges (1001-2000g)</label>
                <div class="controls">
                  <input type="text" name="shipping_charges1001_2000g" id="shipping_charges1001_2000g" value="{{ $shipping->shipping_charges1001_2000g }}" placeholder="Shipping Charges" required>
                </div>
              </div>  
              <div class="control-group">
                <label class="control-label">Shipping Charges (2001-5000g)</label>
                <div class="controls">
                  <input type="text" name="shipping_charges2001_5000g" id="shipping_charges2001_5000g" value="{{ $shipping->shipping_charges2001_5000g }}" placeholder="Shipping Charges" required>
                </div>
              </div>   
              <div class="form-actions">
                <input type="submit" value="Edit Shipping" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
 
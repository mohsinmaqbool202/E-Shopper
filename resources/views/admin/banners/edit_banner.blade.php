@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Banners</a> <a href="#" class="current">Edit Banner </a> </div>
    <h1>Edit Banner Here</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Banner Details</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/edit-banner/'.$banner->id) }}" name="edit_banner" id="edit_banner" novalidate="novalidate">
              {{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Banner Image</label>
                <div class="controls">
                  <input type="file" name="image" id="image">
                  @if(!empty($banner->image))
                  <input type="hidden" name="current_image" value="{{ $banner->image }}">
                  <img src="{{ asset('/images/frontend_images/banners/'.$banner->image) }}" style="width: 100px; height: 50px;">
                  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Banner Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" value="{{ $banner->title }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Banner Link</label>
                <div class="controls">
                  <input type="text" name="link" id="link" value="{{ $banner->link }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Enable Banner</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1" @if($banner->status == 1)checked @endif>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Edit Banner" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
 
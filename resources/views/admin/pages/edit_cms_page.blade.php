@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">CMS Pages</a> <a href="#" class="current">Edit CMS Page </a> </div>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Page Details</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/edit-cms-page/'.$page->id)}}" name="add-cms-page" id="add-cms-page" novalidate="novalidate">
              {{ csrf_field() }}

              <div class="control-group">
                <label class="control-label">Under</label>
                <div class="controls">
                 <select name="under" id="under" style="width: 220px;" required>
                  <option selected disabled>Select Category</option>
                  <option value="Service" @if($page->under == 'Service')selected @endif>Service</option>
                  <option value="Quick Shop" @if($page->under == 'Quick Shop')selected @endif>Quick Shop</option>
                  <option value="Policies" @if($page->under == 'Policies')selected @endif>Policies</option>
                  <option value="About Shopper" @if($page->under == 'About Shopper')selected @endif>About Shopper</option>
                 </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" value="{{ $page->title }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Page Url</label>
                <div class="controls">
                  <input type="text" name="url" id="url" value="{{ $page->url }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea name="description" id="description" rows="4" cols="7">{{ $page->description }}</textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Meta Title</label>
                <div class="controls">
                  <input type="text" name="meta_title" id="meta_title" value="{{ $page->meta_title }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Meta Description</label>
                <div class="controls">
                  <input type="text" name="meta_description" id="meta_description" value="{{ $page->meta_description }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Meta Keywords</label>
                <div class="controls">
                  <input type="text" name="meta_keywords" id="meta_keywords" value="{{ $page->meta_keywords }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" @if($page->status == 1)checked value="1" @endif>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Save Changes" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
 
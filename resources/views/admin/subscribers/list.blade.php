@extends('layouts.adminLayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">NewsLetter</a> <a href="#" class="current">View Subscribers</a> </div>
      @if(Session::has('flash_message_success'))  
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session::get('flash_message_success') }}</strong>
        </div>
      @endif 
  </div>
  <div style="margin-top: 10px; margin-right: 10px;">
    <a href="{{ url('/admin/export-newsletter-emails') }}" class="btn btn-info pull-right">Export</a>
  </div>  
  <div class="container-fluid">
    <!-- <hr> -->
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Subscribers List</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>User Email</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($subscribers as $subscriber)
                <tr class="gradeX">
                  <td>{{ $subscriber->id }}</td>
                  <td>{{ $subscriber->email }}</td>
                  <td>
                     @if($subscriber->status == 1)
                        <a href="{{url('/admin/update-subscriber-status/'.$subscriber->id.'/0')}}" class="btn btn-success btn-mini">Active</a>
                     @else
                        <a href="{{url('/admin/update-subscriber-status/'.$subscriber->id.'/1')}}" class="btn btn-danger btn-mini">Inactive</a>
                     @endif
                  </td>
                  <td class="center">
                    <a rel="{{ $subscriber->id }}" rel1="delete-subscriber" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

 @extends('layouts.adminLayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Currencies</a> <a href="#" class="current">List</a> </div>
      @if(Session::has('flash_message_error'))  
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session::get('flash_message_error') }}</strong>
        </div>
      @endif 
      @if(Session::has('flash_message_success'))  
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session::get('flash_message_success') }}</strong>
        </div>
      @endif 
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Currency Code</th>
                  <th>Exchange Rate</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              	@foreach($currencies as $currency)
               <tr class="gradeX">
                  <td>{{ $currency->id }}</td>
                  <td>{{ $currency->currency_code }}</td>
                  <td>{{ $currency->exchange_rate}}</td>
                  <td>
                    @if($currency->status == 1)<span class="badge badge-success">Active</span>@else<span class="badge badge-danger">InActive</span>@endif
                  </td>
                  <td class="center">
                    <a href="{{url('/admin/edit-currency/'.$currency->id)}}" class="btn btn-primary btn-mini" title="Edit Currency">Edit</a> 
                    <a rel="{{ $currency->id }}" rel1="delete-currency" href="javascript:" class="btn btn-danger btn-mini deleteRecord" title="Delete Currency">Delete</a>
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

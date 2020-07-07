<!--sidebar-menu-->
<div id="sidebar"><a href="{{ route('admin.dashboard') }}" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="active"><a href="{{ route('admin.dashboard') }}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    @if(Session::get('admin_info')['categories_access'] == 1)
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{ url('/admin/add-category') }}">Add Category</a></li>
        <li><a href="{{ url('/admin/view-category') }}">View Category</a></li>
      </ul>
    </li>
    @endif
    @if(Session::get('admin_info')['products_access'] == 1)
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Products</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{ url('/admin/add-product') }}">Add Product</a></li>
        <li><a href="{{ url('/admin/view-products') }}">View Products</a></li>
      </ul>
    </li>
    @endif
    @if(Session::get('admin_info')['orders_access'] == 1)
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Orders</span> <span class="label label-important">1</span></a>
      <ul>
        <li><a href="{{ url('/admin/view-orders') }}">View Orders</a></li>
      </ul>
    </li>
    @endif
    @if(Session::get('admin_info')['users_access'] == 1)
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Users</span> <span class="label label-important">1</span></a>
      <ul>
        <li><a href="{{ url('/admin/view-users') }}">View Users</a></li>
      </ul>
    </li>
    @endif
    @if(Session::get('admin_info')['type'] == 'Admin')
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Coupons</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{ url('/admin/add-coupon') }}">Add Coupon</a></li>
        <li><a href="{{ url('/admin/view-coupons') }}">View Coupon</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Banners</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{ url('/admin/add-banner') }}">Add Banner</a></li>
        <li><a href="{{ url('/admin/view-banners') }}">View Banners</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Admins/Sub-Admins</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{ url('/admin/add-admin') }}">Add Admin/Sub-Admin</a></li>
        <li><a href="{{ url('/admin/view-admins') }}">View Admin/Sub-Admins</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>CMS Pages</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{ url('/admin/add-cms-page') }}">Add CMS Page</a></li>
        <li><a href="{{ url('/admin/view-cms-pages') }}">View CMS Pages</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Currencies</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{ url('/admin/add-currency') }}">Add Currency</a></li>
        <li><a href="{{ url('/admin/view-currencies') }}">View Currencies</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Shipping</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{ url('/admin/add-shipping') }}">Add Shipping Charges</a></li>
        <li><a href="{{ url('/admin/view-shipping') }}">View Shipping Charges</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Subscribers</span> <span class="label label-important">1</span></a>
      <ul>
        <li><a href="{{ url('/admin/view-subscribers') }}">View Subscribers</a></li>
      </ul>
    </li>
    @endif
  </ul>
</div>
<!--sidebar-menu-->
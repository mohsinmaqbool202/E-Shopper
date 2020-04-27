<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');



//Admin Login page Route
Route::match(['get', 'post'], '/admin', 'AdminController@login');

//Home Page Routes
Route::get('/', 'IndexController@index');

//Listing Products on category base Routes
Route::get('/products/{url}', 'ProductsController@products');

//Product detail page
Route::get('product/{id}', 'ProductsController@product');
//get product attribute price
Route::get('/get-product-price', 'ProductsController@getProductPrice');

//Add-to-cart routes
Route::post('/add-cart', 'ProductsController@addtocart');

//cart page route
Route::match(['get', 'post'], '/cart', 'ProductsController@cart');

//Delete cart items route
Route::get('/cart/delete-product/{id}', 'ProductsController@deleteCartProduct');

//update product quantity in cart
Route::get('/cart/upadte-quantity/{id}/{quantity}', 'ProductsController@updateCartQuantity');

//Apply Coupon
Route::post('/cart/apply-coupon', 'ProductsController@applyCoupon');

//user register /login page
Route::get('/login-register', 'UsersController@userLoginRegister');

//User register form submit
Route::post('/user-register', 'UsersController@register');

//check email if user already exist or not
Route::get('/check-email', 'UsersController@checkEmail');

//user login route
Route::post('/user-login', 'UsersController@login');

//user logout route
Route::get('/user-logout', 'UsersController@userlogout');


Route::group(['middleware' => ['frontlogin']], function(){

   //user account page
   Route::match(['get', 'post'], '/account', 'UsersController@account');
   //update user pwd
   Route::get('/check-user-pwd', 'UsersController@checkUserPwd');
   Route::post('/update_user_pwd', 'UsersController@updatePassword');
   //checkout page
   Route::match(['get','post'], '/checkout', 'ProductsController@checkout');
   //order review 
   Route::get('/order-review', 'ProductsController@orderReview');
   //place order
   Route::match(['get','post'], '/place-order', 'ProductsController@placeOrder');

   //For thanks page
   Route::get('/thanks', 'ProductsController@thanks');

   //View user orders
   Route::get('/orders', 'ProductsController@userOrders');
    //View user orders detail
   Route::get('/order/{id}', 'ProductsController@userOrderDetail');

});


Route::group(['middleware' => ['auth']], function(){

   Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
   Route::get('/logout', 'AdminController@logout');
   Route::get('/admin/settings', 'AdminController@settings');
   Route::get('/admin/check-pwd', 'AdminController@checkPassword');
   Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@updatePassword');

   //categories routes (Admin)
   Route::match(['get', 'post'], '/admin/add-category', 'CategoryController@addCategory');
   Route::get('/admin/view-category', 'CategoryController@viewCategories');
   Route::match(['get', 'post'], '/admin/edit-category/{id}', 'CategoryController@editCategory');
   Route::match(['get', 'post'], '/admin/delete-category/{id}', 'CategoryController@deleteCategory');

   //Products Routes
   Route::match(['get', 'post'], '/admin/add-product', 'ProductsController@addProduct');
   Route::get('/admin/view-products', 'ProductsController@viewProducts');
   Route::match(['get', 'post'], '/admin/edit-product/{id}', 'ProductsController@editProduct');
   Route::get('/admin/delete-product-image/{id}', 'ProductsController@deleteProductImage');
   Route::get('/admin/delete-product/{id}', 'ProductsController@deleteProduct');

   //Product Attributes + Images Routes
   Route::match(['get', 'post'], '/admin/add-attributes/{id}', 'ProductsController@addAttributes');
   Route::match(['get', 'post'], '/admin/edit-attributes/{id}', 'ProductsController@editAttributes');
   Route::match(['get', 'post'], '/admin/add-images/{id}', 'ProductsController@addImages');
   Route::get('/admin/delete-attribute/{id}', 'ProductsController@deleteAttribute');
   Route::get('/admin/delete-alt-image/{id}', 'ProductsController@deleteAltImage');

   //Coupon Code Routed
   Route::match(['get', 'post'], '/admin/add-coupon', 'CouponsController@addCoupon');
   Route::get('/admin/view-coupons', 'CouponsController@viewCoupons');
   Route::match(['get', 'post'], '/admin/edit-coupon/{id}', 'CouponsController@editCoupon');
   Route::get('/admin/delete-coupon/{id}', 'CouponsController@deleteCoupon');

   //Banners Route
   Route::match(['get', 'post'], '/admin/add-banner', 'BannersController@addBanner');
   Route::get('/admin/view-banners', 'BannersController@viewBanners');
   Route::match(['get', 'post'], '/admin/edit-banner/{id}', 'BannersController@editBanner');
   Route::get('/admin/delete-banner/{id}', 'BannersController@deleteBanner');

});




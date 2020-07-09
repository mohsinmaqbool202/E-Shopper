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

//Color filter Route
Route::match(['get','post'], 'products/filter', 'ProductsController@filter');

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

//forgot password
Route::match(['get', 'post'], '/forgot-password', 'UsersController@forgotPassword');

//activate account 
Route::get('/confirm/{code}', 'UsersController@confirmAccount');

//check email if user already exist or not
Route::get('/check-email', 'UsersController@checkEmail');

//user login route
Route::post('/user-login', 'UsersController@login');

//user logout route
Route::get('/user-logout', 'UsersController@userlogout');

//search products
Route::post('/search-pruducts', 'ProductsController@searchProduct');

//display cms page on user side
Route::get('/page/{url}', 'CmsController@cmsPage');

//contact us
Route::match(['get', 'post'], '/contact-us', 'CmsController@contact');

//check pincode
Route::get('/check-pincode', 'ProductsController@checkPincode');

//newsletter subscriber
Route::post('/newsletter-subscribe', 'NewsletterController@addSubscriber');


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
   //paypal page
   Route::get('/paypal', 'ProductsController@paypal');
   Route::post('/paypal', 'PaymentController@payWithpaypal');
   Route::get('status'  , 'PaymentController@getPaymentStatus');

   //View user orders
   Route::get('/orders', 'ProductsController@userOrders');
    //View user orders detail
   Route::get('/order/{id}', 'ProductsController@userOrderDetail');

   //wishllist route
   Route::get('/add-to-wishlist', 'ProductsController@addToWishList');
   Route::get('/wish-list', 'ProductsController@viewWishList');
   Route::get('/delete-wish/{id}', 'ProductsController@deleteWishList');

});


Route::group(['middleware' => ['adminlogin']], function(){

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
   Route::get('/admin/delete-product-video/{id}', 'ProductsController@deleteProductVideo');
   Route::get('/admin/delete-product/{id}', 'ProductsController@deleteProduct');
   Route::get('/admin/export-products', 'ProductsController@exportProducts');


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

   //view orders route
   Route::get('/admin/view-orders', 'ProductsController@viewOrders');
   Route::get('/admin/view-order/{id}', 'ProductsController@viewOrderDetail');
   Route::get('/admin/view-order-invoice/{id}', 'ProductsController@viewOrderInvoice');
   Route::get('/admin/view-pdf-invoice/{id}', 'ProductsController@viewPDFInvoice');


   //update order status
   Route::post('/admin/update-order-status', 'ProductsController@updateOrderStatus');

   //View all users
   Route::get('/admin/view-users','UsersController@viewUsers');
   Route::get('/admin/export-users', 'UsersController@exportUsers');


   //view admins/sub-admins
   Route::get('/admin/view-admins', 'AdminController@viewAdmins');
   Route::match(['get', 'post'], '/admin/add-admin', 'AdminController@addAdmin');
   Route::match(['get', 'post'], '/admin/edit-admin/{id}', 'AdminController@editAdmin');



   //cms pages
   Route::match(['get','post'],'/admin/add-cms-page', 'CmsController@addCmsPage');
   Route::get('/admin/view-cms-pages', 'CmsController@viewCmsPages');
   Route::get('/admin/delete-cms-page/{id}', 'CmsController@deleteCmsPages');
   Route::match(['get','post'],'/admin/edit-cms-page/{id}', 'CmsController@editCmsPage');

   //currency routes
   Route::match(['get','post'],'/admin/add-currency', 'CurrencyController@addCurrency');
   Route::get('/admin/view-currencies', 'CurrencyController@viewCurrencies');
   Route::match(['get','post'],'/admin/edit-currency/{id}', 'CurrencyController@editCurrency');
   Route::get('/admin/delete-currency/{id}', 'CurrencyController@deleteCurrency');

   //Shipping charges routes
   Route::match(['get','post'],'/admin/add-shipping','ShippingController@addShipping');
   Route::get('/admin/view-shipping','ShippingController@viewShipping');
   Route::match(['get','post'],'/admin/edit-shipping/{id}','ShippingController@editShipping');
   Route::get('/admin/delete-shipping/{id}','ShippingController@deleteShipping');

   //Newsletter Subscriber
   Route::get('/admin/view-subscribers', 'NewsletterController@viewSubscribers');
   Route::get('/admin/update-subscriber-status/{id}/{status}', 'NewsletterController@updateSubscriberStatus');
   Route::get('/admin/delete-subscriber/{id}', 'NewsletterController@deleteSubscriber');
   Route::get('/admin/export-newsletter-emails', 'NewsletterController@exportSubscribersEmails');

   //charts
   Route::get('/charts', 'AdminController@charts');      

});




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





//Home Page Routes
Route::get('/', 'IndexController@index');

//Listing Products on category base Routes
Route::get('/products/{url}', 'ProductsController@products');

//Product detail page
Route::get('product/{id}', 'ProductsController@product');
//get product attribute price
Route::get('/get-product-price', 'ProductsController@getProductPrice');


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
   Route::match(['get', 'post'], '/admin/add-images/{id}', 'ProductsController@addImages');
   Route::get('/admin/delete-attribute/{id}', 'ProductsController@deleteAttribute');
   Route::get('/admin/delete-alt-image/{id}', 'ProductsController@deleteAltImage');
});

   Route::match(['get', 'post'], '/admin', 'AdminController@login');



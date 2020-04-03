<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Image;
use App\Category;
use App\Product;
use App\ProductAttribute;
use App\ProductImage;
use App\Cart;
use App\Coupon;
use App\Banner;
use App\Country;
use Auth;
use App\User;
use App\DeliveryAddress;

class ProductsController extends Controller
{
    public function addProduct(Request $request)
    {
    	if($request->isMethod('post'))
    	{
            $data = $request->all();
            if(empty($data["status"])){
                $status = 0;
            }
            else
            {
                $status = 1;
            }

    		$product = new Product;

    		$product->category_id    = $request->category_id;
    		$product->product_name   = $request->product_name; 
    		$product->product_code   = $request->product_code; 
    		$product->product_color  = $request->product_color; 
    		$product->price          = $request->price; 
    		$product->description    = $request->description; 
            $product->care           = $request->care;
            $product->status         = $status;

    		//Storing Product Image
    		if($request->hasFile('image'))
    		{
    			$image_temp = Input::file('image');
    			if($image_temp->isValid())
    			{
    				$extension = $image_temp->getClientOriginalExtension();
    				$filename = rand(111,99999). '.'. $extension;

    				$large_image_path = 'images/backend_images/products/large/'.$filename;
    				$medium_image_path = 'images/backend_images/products/medium/'.$filename;
    				$small_image_path = 'images/backend_images/products/small/'.$filename;

    				//Resize Image
    				Image::make($image_temp)->resize(1200,1200)->save($large_image_path);
    				Image::make($image_temp)->resize(600,600)->save($medium_image_path);
    				Image::make($image_temp)->resize(300,300)->save($small_image_path);

    				$product->image = $filename;
    			}
    		}
    		$product->save();
    		return redirect('/admin/view-products')->with('flash_message_success', 'Product Added.');
    	}

        //Categories Dropdown Start
    	$main_categories = Category::where('parent_id', 0)->get();
    	$categories_dropdown  =  "<option selected disabled>Select</option>";
    		foreach($main_categories as $cat)
    		{
    			$categories_dropdown .= "<option value='".$cat->id."'>". $cat->name."</option>";
    			$sub_categories = Category::where('parent_id', $cat->id)->get();
    			 foreach($sub_categories as $sub_cat)
    			 {
    			   $categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp;". $sub_cat->name."</option>";
    			 }
    		}
        // Categories dropdown ends    
    	return view('admin.products.add_product', compact('categories_dropdown'));
    }
    public function viewProducts()
    {
    	$products = Product::orderBy('id','desc')->get();
        
    	return view('admin.products.view_products', compact('products'));
    }

    //Edit Product Function
    public function editProduct(Request $request, $id)
    {
        $data = $request->all();
        //For Post Request
        if($request->isMethod('post'))
        {
            //Storing Product Image
            if($request->hasFile('image'))
            {
                $image_temp = Input::file('image');
                if($image_temp->isValid())
                {
                    $extension = $image_temp->getClientOriginalExtension();
                    $filename = rand(111,99999). '.'. $extension;

                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;

                    //Resize Image
                    Image::make($image_temp)->resize(1200,1200)->save($large_image_path);
                    Image::make($image_temp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_temp)->resize(300,300)->save($small_image_path);
                }
            }else{
                $filename = $request->current_image;
            }

            if(empty($data["status"])){
                $status = 0;
            }
            else{
                $status = 1;
            }

            Product::where('id', $id)->update(['category_id'=> $data['category_id'],'product_name'=> $data['product_name'],'product_code'=> $data['product_code'],'product_color'=> $data['product_color'],'description'=> $data['description'],'care'=> $data['care'],'price'=> $data['price'], 'image'=> $filename, 'status'=> $status]);
           return redirect('/admin/view-products')->with('flash_message_success', 'Product Updated Successfully.');
        }

        //For Get Request
        $product = Product::find($id);
        //Categories Dropdown Start
        $main_categories = Category::where('parent_id', 0)->get();
        $categories_dropdown  =  "<option selected disabled>Select</option>";
            foreach($main_categories as $cat)
            {
                if($product->category_id == $cat->id){
                    $selected = "selected";
                }else{
                    $selected = "";
                }
                $categories_dropdown .= "<option value='".$cat->id."' ".$selected." >". $cat->name."</option>";
                $sub_categories = Category::where('parent_id', $cat->id)->get();
                 foreach($sub_categories as $sub_cat)
                 {
                     if($product->category_id == $sub_cat->id){
                        $selected = "selected";
                    }else{
                        $selected = "";
                    }
                   $categories_dropdown .= "<option value='".$sub_cat->id."' ".$selected." >&nbsp;--&nbsp;". $sub_cat->name."</option>";
                 }
            }
        // Categories dropdown ends    

        return view('admin.products.edit_product', compact('product', 'categories_dropdown'));
    }

    public function deleteProductImage($id)
    {    
        //Delete Product image from folders
         $productImage = Product::where('id', $id)->first();
        //product images path
        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        //Delete images from folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
          }
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
          } 
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
          }    

         //Delete img from products table 
        Product::where('id', $id)->update(['image'=> '']);
        return back();
    }

    //Delete Product Function
    public function deleteProduct($id)
    {
        //Delete Product image from folders
         $productImage = Product::where('id', $id)->first();
        //product images path
        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        //Delete images from folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
          }
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
          } 
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
          }    

         //Delte Product from table 
        Product::where('id', $id)->delete();
        return redirect('/admin/view-products')->with('flash_message_success', 'Product Has Been Deleted Successfully.');
    }

    //Product Attributes Related Functions
    public function addAttributes(Request $request, $id)
    {
        if($request->isMethod('post'))
        {

            $data = $request->all();
            foreach($data['sku'] as $key=> $val)
            {
                if(!empty($val)){

                    //prevent duplicate sku
                    $attrCountSku = ProductAttribute::where('sku', $val)->count();
                    if($attrCountSku > 0){
                        return redirect('/admin/add-attributes/'.$id)->with('flash_message_error', 'SKU already exist. Please add other SKU');
                    }

                    //prevent duplicate size for same product
                    $attrCountSize = ProductAttribute::where('product_id', $id)->where('size',$data['size'][$key])->count();
                    if($attrCountSize > 0){
                        return redirect('/admin/add-attributes/'.$id)->with('flash_message_error', $data['size'][$key].' size already exists for this product. Please add other size.');
                    }


                    $attribute = new ProductAttribute;
                    $attribute->product_id  = $data['product_id'];
                    $attribute->sku   = $val;
                    $attribute->size  = $data['size'][$key];
                    $attribute->price  = $data['price'][$key];
                    $attribute->stock  = $data['stock'][$key];
                    $attribute->save();
                }
            }
        return redirect('/admin/add-attributes/'.$id)->with('flash_message_success', 'Product Attributes Added.');
        }


        $productDetails = Product::with('attributes')->where('id', $id)->get();
        return view('admin.products.add_attributes', compact('productDetails'));
    }

    //Edit product attributes function
    public function editAttributes(Request $request, $id)
    {
        if($request->isMethod('post'))
        {
           $data = $request->all();
           foreach ($data['idAttr'] as $key => $attr) {
               ProductAttribute::where('product_id', $id)->where('id', $data['idAttr'][$key])->update([ 'price'=>$data['price'][$key], 'stock'=>$data['stock'][$key] ]);
           }

           return back()->with('flash_message_success', 'Product Attributes has been updated successfully!');
        }
    }

    //Add Alternate Images for product
    public function addImages(Request $request, $id)
    {
        $productDetails = Product::where('id', $id)->get();

        if($request->isMethod('post'))
        {
            $data = $request->all();
            if($request->hasFile('image')){
                $files = Input::file('image');
                foreach($files as $file)
                {
                    //Upload Image After Resizing
                    $image = new ProductImage;
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;

                    $large_image_path = 'images/backend_images/products/large/'.$fileName;
                    $medium_image_path = 'images/backend_images/products/medium/'.$fileName;
                    $small_image_path = 'images/backend_images/products/small/'.$fileName;

                    //Resize Image
                    Image::make($file)->resize(1200,1200)->save($large_image_path);
                    Image::make($file)->resize(600,600)->save($medium_image_path);
                    Image::make($file)->resize(300,300)->save($small_image_path);

                    //Saving to DB
                    $image->product_id = $data['product_id'];
                    $image->image = $fileName;
                    $image->save();
                }
            }

            return redirect('admin/add-images/'.$request->product_id)->with('flash_message_success', 'Images Have Been Added !.');
        }
        return view('admin.products.add_images', compact('productDetails'));
    }

    //Delete Alternate Imges
     public function deleteAltImage($id)
    {    
        //Delete Product image from folders
         $productImage = ProductImage::where('id', $id)->first();
        //product images path
        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        //Delete images from folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
          }
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
          } 
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
          }    

         //Delete img from products table 
        ProductImage::where('id', $id)->delete();
        return back()->with('flash_message_success', 'Image Deleted!');
    }

    //Delete product Attribute
    public function deleteAttribute($id)
    {
        ProductAttribute::where('id', $id)->delete();
        return back()->with('flash_message_success', 'Product Attributes Deleted.');
    }

    public function products($url)
    {
       //display 404 error if url doesnot exist
        $categoryCount = Category::where('url', $url)->where('status', 1)->count();
        if($categoryCount == 0)
        {
          abort(404);
        }
        //Get Categories and sub-categories
        $categories = Category::with('categories')->where('parent_id', 0)->get();
        //get banners
        $banners = Banner::where('status', 1)->get();

        $categoryDetails = Category::where('url', $url)->first();
            if($categoryDetails->parent_id == 0)
            {
                //if url is of main cat
                $subCategories = Category::where('parent_id', $categoryDetails->id)->get();
                $cat_ids = [];
                foreach($subCategories as $subcat){
                    $cat_ids[] .= $subcat->id;
                }
                $productsAll = Product::where('status', 1)->whereIn('category_id', $cat_ids)->get();
            }
            else
            {
                //if url is of sub cat
                $productsAll = Product::where('status', 1)->where('category_id', $categoryDetails->id)->get();
            }

        return view('products.listing', compact('categoryDetails', 'categories', 'productsAll', 'banners'));
    }

    public function product($id)
    {
        $productDetail = Product::with('attributes')->where('id', $id)->first();

        //check if product is enable or not
        if($productDetail->status == 0)
        {
         abort(404);
        }

        $relatedProducts = Product::where('id', '!=', $id)->where('category_id', $productDetail->category_id)->get();

        $productAltImages = $productDetail->alternateImages;
        $product_stock = ProductAttribute::where('product_id', $id)->sum('stock');


         //Get Categories and sub-categories
        $categories = Category::with('categories')->where('parent_id', 0)->get();

        return view('products.detail', compact('productDetail', 'categories','productAltImages', 'product_stock', 'relatedProducts'));
    }

    public function getProductPrice(Request $request)//getting product price using ajax
    {
        $data = $request->all();
        $proArr = explode("-", $data["idSize"]);
        
        $proAttr = ProductAttribute::where('product_id', $proArr[0])->where('size', $proArr[1])->first();
        echo $proAttr->price;
        echo "#";
        echo $proAttr->stock; die;
    }

    public function addtocart(Request $request)
    {
        //Removing Old values from sessions on updating cart
        Session::put('CouponAmount');
        Session::put('CouponCode');

        $sizeArr = explode("-", $request->size);
        $request["size"]        = $sizeArr[1];
        
        //Check if Requested Quuantity is available in stock or not
        $checkStock = ProductAttribute::where('product_id',$sizeArr[0])->where('size',$sizeArr[1])->first();
        if($request->quantity > $checkStock->stock){
          return back()->with('flash_message_error', 'Sorry! Requested product quantity is not available.');
        }


        //Saving session_id to Session
        $session_id = Session::get('session_id');

        if(empty($session_id)){
          $request["session_id"]  = str_random(40);    
          Session::put('session_id', $request["session_id"]);
        }
        else{
          $request["session_id"] = $session_id;
          Session::put('session_id', $request["session_id"]);
        }

        //Check if same product is already present in cart with same size and same session _id
        $checkCart = Cart::where('product_id', $request->product_id)->where('product_color', $request->product_color)->where('size', $sizeArr[1])->where('session_id',$session_id)->get();

        if(count($checkCart) > 0){
          return back()->with('flash_message_error', 'Product already exist in cart.');
        }
        else{
            $getSKU = ProductAttribute::select('sku')->where([['product_id', $request->product_id], ['size',$sizeArr[1]]])->first();
            $request["product_code"] = $getSKU->sku;
           Cart::create($request->all());
        }

        return redirect('/cart')->with('flash_message_success', 'Product added to cart.');
    }

    public function cart()
    {   
        $session_id = Session::get('session_id');
        $userCart = Cart::where('session_id', $session_id)->get();

        return view('products.cart', compact('userCart'));
    }

    public function deleteCartProduct($id)
    {
        //Removing Old values from sessions on updating cart
        Session::put('CouponAmount');
        Session::put('CouponCode');
        
        Cart::where('id', $id)->delete();
        return back()->with('flash_message_success', 'Product deleted from cart.');;
    }

    public function updateCartQuantity($id, $quantity)
    {
      //Removing Old values from sessions on updating cart
      Session::put('CouponAmount');
      Session::put('CouponCode');

      $getCartDetails = Cart::find($id);
      $getProductStock = ProductAttribute::where('sku', $getCartDetails->product_code)->first();

      $updated_quantity = $getCartDetails->quantity + $quantity;
      if($getProductStock->stock >= $updated_quantity)
      {
        Cart::where('id', $id)->increment('quantity', $quantity);
        return back();
      }
      else
      {
        return redirect('cart')->with('flash_message_error', 'Required product quantity is not available');
      }

    }

    //Check Coupon
    public function applyCoupon(Request $request)
    {
        //Removing Old values from sessions
        Session::put('CouponAmount');
        Session::put('CouponCode');

        $couponCount = Coupon::where('coupon_code', $request->coupon_code)->count();
        if($couponCount == 0)
        {
            return back()->with('flash_message_error', 'Coupon is invalid.');
        }
        else{
           
           $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();

           //check if coupon is inActive
           if($coupon->status == 0){
            return back()->with('flash_message_error', 'Coupon is In-Active.');
           }

           //check expiry date
           $curr_date = date('Y-m-d');
           if($coupon->expiry_date < $curr_date){
             return back()->with('flash_message_error', 'Coupon is Expired.');
           }

           //Coupon is Valid for discount
           //Get cart total amount
           $total_amount = 0;
           $session_id = Session::get('session_id');
           $userCart = Cart::where('session_id', $session_id)->get();
           foreach($userCart as $item){
            $total_amount = $total_amount + ($item->product_price*$item->quantity);
           }
           
           //check coupon amount_type is fixed or in %
           if($coupon->amount_type == "fixed"){
             $couponAmount = $coupon->amount;
           }
           else{
            $couponAmount = $total_amount * ($coupon->amount/100);
           }

           //Save couponAmount and coupon code in session
           Session::put('CouponAmount', $couponAmount);
           Session::put('CouponCode', $coupon->coupon_code);
            return redirect()->back()->with('flash_message_success', 'Coupon code successfully applied.You are availing discount');
        }
    }

    //checkout page function
    public function checkout(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();

        //check if shipping address already exist
        $shipping_address = DeliveryAddress::where('user_id', $user->id)->first();
         
        //For post Request
        if($request->isMethod('post'))
        {
            $this->validate($request, [

                'billing_name'        => 'required',
                'billing_address'     => 'required',
                'billing_city'        => 'required',
                'billing_state'       => 'required',
                'country_id'          => 'required',
                'billing_pincode'     => 'required',
                'billing_mobile'      => 'required',
                'shipping_name'       => 'required',
                'shipping_address'    => 'required',
                'shipping_city'       => 'required',
                'shipping_state'      => 'required',
                'shipping_country_id' => 'required',
                'shipping_pincode'    => 'required',
                'shipping_mobile'     => 'required',

            ]);

            //update users table with billing address data
            User::where('id', $user->id)->update(['name'=> $request->billing_name, 'address'=>$request->billing_address, 'city'=> $request->billing_city, 'state'=> $request->billing_state, 'country_id'=> $request->country_id, 'pincode'=>$request->billing_pincode, 'mobile'=>$request->billing_mobile]);
            
            //Now Insert Shipping data to delivery_address table
            if($shipping_address !=''){
              //update record
              DeliveryAddress::where('user_id', $user->id)->update(['name'=> $request->shipping_name, 'address'=>$request->shipping_address, 'city'=> $request->shipping_city, 'state'=> $request->shipping_state, 'country_id'=> $request->shipping_country_id, 'pincode'=>$request->shipping_pincode, 'mobile'=>$request->shipping_mobile]);
            }
            else{

                $new_address = new DeliveryAddress;
                $new_address->user_id     = $user->id;
                $new_address->user_email  = $user->email;
                $new_address->name        = $request->shipping_name;
                $new_address->address     = $request->shipping_address;
                $new_address->city        = $request->shipping_city;
                $new_address->state       = $request->shipping_state;
                $new_address->country_id  = $request->shipping_country_id;
                $new_address->pincode     = $request->shipping_pincode;
                $new_address->mobile      = $request->shipping_mobile;

                $new_address->save();
                
                
            }

            dd('done');   

        }

        return view('products.checkout', compact('user', 'countries', 'shipping_address'));
    }
}

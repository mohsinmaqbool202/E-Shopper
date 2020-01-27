<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use App\Category;
use App\Product;
class ProductsController extends Controller
{
    public function addProduct(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$product = new Product;

    		$product->category_id    = $request->category_id;
    		$product->product_name   = $request->product_name; 
    		$product->product_code   = $request->product_code; 
    		$product->product_color   = $request->product_color; 
    		$product->price   = $request->price; 
    		$product->description   = $request->description; 

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
    	$products = Product::all();
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

            Product::where('id', $id)->update(['category_id'=> $data['category_id'],'product_name'=> $data['product_name'],'product_code'=> $data['product_code'],'product_color'=> $data['product_color'],'description'=> $data['description'],'price'=> $data['price'], 'image'=> $filename ]);
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
        Product::where('id', $id)->update(['image'=> '']);
        return back();
    }

    //Delete Product Function
    public function deleteProduct($id)
    {
        Product::where('id', $id)->delete();
        return redirect('/admin/view-products')->with('flash_message_success', 'Product Has Been Deleted Successfully.');
    }
}

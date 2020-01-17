<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    		$product->save();
    		return redirect()->back()->with('flash_message_success', 'Product Added.');
    	}
    	$main_categories = Category::where('parent_id', 0)->get();
    	$categories_dropdown  =  "<option value = '' selected disabled>Select</option>";
    		foreach($main_categories as $cat)
    		{
    			$categories_dropdown .= "<option value='".$cat->id."'>". $cat->name."</option>";
    			$sub_categories = Category::where('parent_id', $cat->id)->get();
    			 foreach($sub_categories as $sub_cat)
    			 {
    			   $categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp;". $sub_cat->name."</option>";
    			 }
    		}
    	return view('admin.products.add_product', compact('categories_dropdown'));
    }
}

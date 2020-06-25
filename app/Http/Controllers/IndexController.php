<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Banner;

class IndexController extends Controller
{
    public function index()
    {
    	//in ascending order by default
    	//$products = Product::apache_lookup_uri(filename)l();

    	//in descending order
    	//$products = Product::orderBy('id', 'DESC')->get();

    	//in random order
    	$products = Product::where(['status'=> 1,'feature_item'=>1])->inRandomOrder()->paginate(15);

    	//Get CAtegoried and sun-categories
    	$categories = Category::with('categories')->where('parent_id', 0)->get();

        //get all banners
        $banners  = Banner::where('status', 1)->get();

        //meta tags
        $meta_title = "E-Shop Sample Website";
        $meta_description = "Online Shopping Site for Men, Women and Kids";
        $meta_keywords = "eshop website, online shopping, men clothing";
        $url = '';
    	return view('index', compact('products', 'categories', 'banners','meta_title','meta_description', 'meta_keywords'));
    }
}

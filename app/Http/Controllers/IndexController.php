<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class IndexController extends Controller
{
    public function index()
    {
    	//in ascending order by default
    	//$products = Product::apache_lookup_uri(filename)l();

    	//in descending order
    	//$products = Product::orderBy('id', 'DESC')->get();

    	//in random order
    	$products = Product::inRandomOrder()->get();

    	//Get CAtegoried and sun-categories
    	$categories = Category::with('categories')->where('parent_id', 0)->get();
    	 
    	return view('index', compact('products', 'categories'));
    }
}

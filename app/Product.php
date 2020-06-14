<?php

namespace App;
use App\Cart;
use Session;
use Auth;
use App\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = ['category_id', 'product_name', 'product_code', 'product_color','price', 'description', 'image', 'video','status', 'feature_item'];


    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function attributes()
    {
    	return $this->hasMany('App\ProductAttribute', 'product_id');
    }

     public function alternateImages()
    {
    	return $this->hasMany('App\ProductImage');
    }

    public static function cartCount()
    {
        if(Auth::check()){
            $user_email = Auth::user()->email;
            $cartCount = Cart::where('user_email', $user_email)->sum('quantity');
        }
        else{
            $session_id = Session::get('session_id');
            $cartCount = Cart::where('session_id', $session_id)->sum('quantity');
        }

        return $cartCount;
    }

    public static function productCount($cat_id)
    {
        $productCount = Product::where(['category_id'=>$cat_id, 'status'=>1])->count();
        return $productCount;
    }

    public static function getCurrencies($price)
    {
        $currencies = Currency::all();
        foreach($currencies as $curr)
        {
            if($curr->currency_code == "USD")
            {
                $USD_Rate =round($price/$curr->exchange_rate,2);
            }
            else if($curr->currency_code == "Yuan")
            {
                $Yuan_Rate =round($price/$curr->exchange_rate,2);

            }
            else if($curr->currency_code == "EUR")
            {
                $EUR_Rate =round($price/$curr->exchange_rate,2);
            }
        }
        
        $currenyArr = ['USD_Rate'=>$USD_Rate, 'Yuan_Rate'=>$Yuan_Rate, 'EUR_Rate'=>$EUR_Rate];
            return $currenyArr;
    }
}

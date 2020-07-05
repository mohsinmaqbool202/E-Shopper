<?php

namespace App;
use App\Cart;
use Session;
use Auth;
use App\Product;
use App\ProductAttribute;

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

    public static function getProductStock($p_id, $p_size){
        $product_stock = ProductAttribute::select('stock')->where(['product_id'=>$p_id, 'size'=>$p_size])->first();
        if($product_stock != null){
         return $product_stock->stock;
        } 
        return null;
    }

    public static function getProductStatus($p_id)
    {
        $product_status = Product::select('status')->where('id',$p_id)->first();
        return $product_status->status;
    }

    public static function deleteProductFromCart($product_code, $session_id, $product_id)
    {
        if(empty($product_id)){
          Cart::where(['product_code'=>$product_code, 'session_id'=>$session_id])->delete();
        }
        else{
         Cart::where(['product_id'=>$product_id, 'session_id'=>$session_id])->delete();
        }
    }

    public static function getAttributeCount($product_id,$product_code)
    {
        $attribute_count = ProductAttribute::where(['product_id'=>$product_id,'sku'=>$product_code])->count();
        return $attribute_count;
    }

    public static function getShippinhCharges($weight, $country_id)
    {
        $shipping_charges = ShippingCharge::where('country_id', $country_id)->first();
        if($weight > 0)
        {
            if($weight>0 && $weight<=500)
            {
                $total_charges = $shipping_charges->shipping_charges0_500g;
            }
            elseif($weight>501 && $weight<=1000)
            {
                $total_charges = $shipping_charges->shipping_charges501_1000g;
            }
            elseif($weight>1001 && $weight<=2000)
            {
                $total_charges = $shipping_charges->shipping_charges1001_2000g;
            }
            elseif($weight>2001 && $weight<=5000)
            {
                $total_charges = $shipping_charges->shipping_charges2001_5000g;
            }
            else
            {
                $total_charges = 0;
            }
        }
        else
        {
            $total_charges = 0;
        }

        return $total_charges;
    }

    public static function getGrandTotal()
    {
        $session_id = Session::get('session_id');
        $userCart = Cart::where('session_id',$session_id)->get();
        foreach($userCart as $product)
        {
            $p_price = ProductAttribute::where(['product_id'=>$product->product_id, 'sku'=>$product->product_code])->pluck('price');
            $priceArray[] = $p_price[0] * $product->quantity;
        }
        
        $grand_total = array_sum($priceArray) - Session::get('CouponAmount') + Session::get('shipping_charges');
        return $grand_total;
    }

    public static function getProductPrice($p_id, $p_code)
    {
        $p_price = ProductAttribute::select('price')->where(['product_id'=>$p_id, 'sku'=>$p_code])->first();
        return $p_price->price;
    }
}

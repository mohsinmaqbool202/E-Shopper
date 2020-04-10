<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_products';

    public function order(){
    	return $this->belongsTo('App\Order');
    }
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function cart(){
    	return $this->belongsTo('App\Cart');
    }
}

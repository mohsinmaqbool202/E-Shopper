<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = ['category_id', 'product_name', 'product_code', 'product_color','price', 'description', 'image'];


    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function productAttribute()
    {
    	return $this->hasOne('App\ProductAttribute');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable = ['product_id', 'sku', 'size', 'price', 'stock'];
    protected $table = 'product_attributes';

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
}

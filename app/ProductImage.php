<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
	protected $fillable = ['product_id', 'image'];
    protected $table = 'product_images';

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
}

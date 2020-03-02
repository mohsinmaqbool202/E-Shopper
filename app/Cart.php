<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [

        'product_id',
        'product_name',
        'product_code',
        'product_color',
        'size',
        'product_price',
        'quantity',
        'user_email',
        'session_id',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}

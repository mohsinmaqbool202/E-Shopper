<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    protected $fillable = ['country_id', 'shipping_charges0_500g','shipping_charges501_1000g','shipping_charges1001_2000g','shipping_charges2001_5000g'];

    public function country()
    {
    	return $this->belongsTo('App\Country');   
    }
}

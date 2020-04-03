<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    protected $table = 'delivery_addresses';

    protected $fillable = [
    		'user_id',
    		'user_email',
    		'shipping_name', 
    		'shipping_address', 
    		'shipping_city',
    		'shipping_state',
    		'country_id',
    		'shipping_pincode',
    		'shipping_mobile'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function country()
    {
    	return $this->belongsTo('App\Country');
    }
}

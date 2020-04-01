<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    protected $table = 'delivery_addressess';

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function country()
    {
    	return $this->belongsTo('App\Country');
    }
}

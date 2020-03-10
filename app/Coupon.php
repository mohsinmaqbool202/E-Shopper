<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    protected $fillable = ['coupon_code', 'amount', 'amount_type', 'expiry_date', 'status'];
}

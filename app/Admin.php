<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [ 
    	                   'username',
                           'password',
                           'type',
                           'categories_access',
                           'products_access',
                           'orders_access',
                           'users_access', 
                           'status'
                        ];
}

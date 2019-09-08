<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'email', 'phone','address','image',
    ];

    public function orders(){

    	return $this->hasMany('App\Model\Order','customer_id','id');
    }
}

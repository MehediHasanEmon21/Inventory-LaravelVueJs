<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'pro_quantity','pro_price','sub_total',
    ];

    public function order(){
    	return $this->belongsTo('App\Model\Order','order_id','id');
    }

    public function product(){
    	return $this->belongsTo('App\Model\Product','product_id','id');
    }
}

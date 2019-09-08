<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     protected $fillable = [
        'customer_id', 'qty', 'sub_total','vat','total','pay','due','payby','order_date','order_month','order_year',
    ];

    public function customer(){
    	return $this->belongsTo('App\Model\Customer','customer_id','id');
    }

    public function order_detail(){
    	return $this->hasOne('App\Model\OrderDetails','order_id','id');
    }
}

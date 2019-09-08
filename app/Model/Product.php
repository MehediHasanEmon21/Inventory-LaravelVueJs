<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = [
        'category_id', 'supplier_id', 'product_name','product_code','root','buying_price','selling_price','buying_date','image','product_quantity',
    ];

    public function category(){
    	return $this->belongsTo('App\Model\Category','category_id','id');
    }

    public function supplier(){
    	return $this->belongsTo('App\Model\Supplier','supplier_id','id');
    }

    public function order_detail(){
    	return $this->hasOne('App\Model\OrderDetail','product_id','id');
    }
}

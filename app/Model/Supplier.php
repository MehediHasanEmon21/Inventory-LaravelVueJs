<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
     protected $fillable = [
        'name', 'email', 'phone','address','shop_name','image',
    ];

    public function products(){
    	return $this->hasMany('App\Model\Supplier','supplier_id','id');
    }

}

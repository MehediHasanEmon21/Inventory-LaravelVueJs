<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
      protected $fillable = [
        'name', 'email', 'phone','address','salary','image','nid','joining_date',
    ];

    public function salary(){
    	return $this->hasOne('App\Model\Salary','employee_id','id');
    }

}

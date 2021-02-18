<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = "orders";

    public function bill_detail(){
    	return $this->hasMany('App\BillDetail','id_bill','id');
    }

    public function customer(){
    	return $this->belongsTo('App\Customer','id_customer','id');
    }
   
    public function users(){
    	return $this->belongsTo('App\User','id_employee','id');
    }
     public function users1(){
        return $this->belongsTo('App\User','id_shipper','id');
    }
    // public function users(){
    // 	return $this->belongsTo('App\User','id_shipper','id');
    // }
    public $timestamps = false;
}

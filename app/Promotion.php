<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
     protected $table = "promotion";
     public function users(){
     	return $this->belongsTo('App\User','id_employee','id');
     }
     public function promotion_detail(){
    	return $this->hasMany('App\Promotion_Detail','promotion_code');
    }
    public $timestamps = false;
}

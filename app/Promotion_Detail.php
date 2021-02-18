<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion_Detail extends Model
{
 	protected $table = "promotion_detail";

    public function product(){
    	return $this->belongsTo('App\Product','id_product');
    }

    public function promotion(){
    	return $this->belongsTo('App\Promotion','promotion_code');
    }
     public $timestamps = false;
}

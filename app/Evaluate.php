<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluate extends Model
{
    //
    	protected $table = "evaluate";
    	public function user()
    	{
    		return $this->belongsTo('App\User','id_user','id');
    	}
    	public function product()
    	{
    		return $this->belongsTo('App\product', 'id', 'id_product');
    	}
         public $timestamps = false;
}

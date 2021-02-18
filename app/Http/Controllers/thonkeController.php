<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
class thonkeController extends Controller
{
    public function hiethithonke(){
    	$ngaythang=date('2019-02-1');
    	$Banh=DB::table('order_detail')->join('products','products.id','=','order_detail.id_product')->select( DB::raw('name,SUM(order_detail.quantity) as quantity, SUM(order_detail.price) as price') )->groupBy('name')->paginate(10); 
    	dd($banh);
    }
}

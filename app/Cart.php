<?php

namespace App;

class Cart
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}
	public function add($item, $id , $promotion,$soluong){
		// dd($item);
		
		if($promotion == null){
			$giohang = ['qty'=>0, 'price' => $item->unit_price, 'item' => $item];
		}
		else{
			$giohang = ['qty'=>0, 'price' => $item->unit_price - ($item->unit_price * ($promotion->percent)/100), 'item' => $item];
		
		}	
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$giohang = $this->items[$id];
			}
		}
		// dd($giohang);
		if($soluong == 1){

			$giohang['qty']++;

		}elseif ($soluong > 1){
			$giohang['qty'] = $soluong;
		}
		if($promotion == null){
			$giohang['price'] = $item->unit_price * $giohang['qty'];
		}
		else{
			$giohang['price'] = ($item->unit_price - ($item->unit_price * ($promotion->percent)/100)) * $giohang['qty'];
		}
		$this->items[$id] = $giohang;
		if($soluong == 1){
			$this->totalQty++;
		}elseif ($soluong > 1) {
			$this->totalQty = $soluong;
		}
		if($soluong == 1){
			if($promotion == null){
				$this->totalPrice += $item->unit_price;
			}
			else{
				$this->totalPrice += $item->unit_price - ($item->unit_price * ($promotion->percent)/100);
			}
		}
		// }elseif ($soluong > 1) {
		// 	if($promotion == null){
		// 		$this->totalPrice = $item->unit_price * $soluong;
		// 	}
		// 	else{
		// 		$this->totalPrice = $this->totalPrice + ($giohang['qty'] - $soluong)*($item->unit_price - ($item->unit_price * ($promotion->percent)/100));
		// 	}
		// }
		// dd($this->totalPrice);
		
	}
	//xóa 1
	public function reduceByOne($id){
		$this->items[$id]['qty']--;
		$this->items[$id]['price'] -= $this->items[$id]['item']['price'];
		$this->totalQty--;
		$this->totalPrice -= $this->items[$id]['item']['price'];
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
	}
	//xóa nhiều
	public function removeItem($id){
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}

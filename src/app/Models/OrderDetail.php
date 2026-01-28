<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model{

	protected $table = 'order_details';
	protected $fillable = [
							'productId',
							'orderId',
							'quantity',
							'totalWeight',
							'totalPrice',
							];
	public function products(){
		return $this->belongsTo(Product::class, 'productId');
	}
	public function orders(){
		return $this->belongsTo(Order::class, 'orderId');
	}
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model{

	protected $table = 'order_details';
	protected $fillable = [
							'product_id',
							'order_id',
							'quantity',
							'total_weight',
							'total_price',
							];
	public function products(){
		return $this->belongsTo(Product::class, 'product_id');
	}
	public function orders(){
		return $this->belongsTo(Order::class, 'order_id');
	}
}


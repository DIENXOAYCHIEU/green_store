<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model{
	use SoftDeletes;

	protected $table= 'orders';
	protected $fillable = [
							'senderId',
							'promotionId',
							'receiverId',
							'price',
							'totalPrice',
							'totalWeight',
							'note',
							'statusId',
							];
	protected $dates =[
						'created_at',
						'deleted_at',
						'updated_at',
						];

	public function senders(){
		return $this->belongsTo(Sender::class, 'senderId');
	}
	public function receivers(){
		return $this->belongsTo(Receiver::class, 'receiverId');
	}
	public function promotions(){
		return $this->belongsTo(Promotion::class, 'promotionId');
	}
	public function statuses(){
		return $this->belongsTo(Status::class, 'statusId');
	}
	public function orderDetails(){
		return $this->hasMany(OrderDetail::class, 'orderId');
	}
	public function bills(){
		return $this->hasMany(Bill::class, 'orderId');
	}
	public function purchases(){
		return $this->hasMany(Purchase::class, 'orderId');
	}
}

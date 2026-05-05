<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model{
	use SoftDeletes;

	protected $table= 'orders';
	protected $fillable = [
							'account_id',
							'sender_id',
							'promotion_id',
							'receiver_id',
							'price',
							'total_price',
							'total_weight',
							'note',
							'status_id',
							];
	protected $dates = [
						'deleted_at',
						'created_at',
						'updated_at',
						];
	public function accounts(){
		return $this->belongsTo(Account::class, 'account_id');
	}
	public function senders(){
		return $this->belongsTo(Sender::class, 'sender_id');
	}
	public function receivers(){
		return $this->belongsTo(Receiver::class, 'receiver_id');
	}
	public function promotions(){
		return $this->belongsTo(Promotion::class, 'promotion_id');
	}
	public function statuses(){
		return $this->belongsTo(Status::class, 'status_id');
	}
	public function orderDetails(){
		return $this->hasMany(OrderDetail::class, 'order_id');
	}
	public function bills(){
		return $this->hasMany(Bill::class, 'order_id');
	}
	public function purchases(){
		return $this->hasMany(Purchase::class, 'order_id');
	}
}

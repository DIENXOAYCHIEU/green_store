<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model{
	use SoftDeletes;

	public $incrementing = false;
	protected $keyType = 'string';

	protected $table= 'orders';
	protected $fillable = [
							'account_id',
							'receiver_id',
							'total_price',
							'note',
							'status_id',
							];
	protected $dates = [
						'deleted_at',
						'created_at',
						'updated_at',
						];
	protected static function boot()
	{
		parent::boot();

		static::creating(function ($model) {
			if (empty($model->{$model->getKeyName()})) {
				$model->{$model->getKeyName()} = now()->format('YmdHis') . mt_rand(1000, 9999);
			}
		});
	}
	public function accounts(){
		return $this->belongsTo(Account::class, 'account_id');
	}
	public function receivers(){
		return $this->belongsTo(Receiver::class, 'receiver_id');
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

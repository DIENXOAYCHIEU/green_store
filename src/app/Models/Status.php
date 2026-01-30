<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model{
	use SoftDeletes;
	const PROCESSING = 'đang xử lý';
	const SHIPPING = 'đang giao';
	const CANCELED = 'đã hủy';
	const PAID = 'đã thanh toán';
	
	protected $table = 'statuses';
	protected $fillable = [
							'name',
							];
	protected $dates = [
						'deleted_at',
						'created_at',
						'updated_at',
						];
	public function orders(){
		return $this->hasMany(Order::class, 'status_id');
	}
}

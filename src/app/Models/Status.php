<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model{
	use SoftDeletes;
	const PROCESSING = 'Chờ xử lý';
	const SHIPPING = 'Đã giao hàng';
	const CANCELED = 'Đã hủy';
	const PAID = 'Đã thanh toán';
	const PAYING = 'Đang thanh toán';
	const DONE = 'Hoàn tất';
	
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

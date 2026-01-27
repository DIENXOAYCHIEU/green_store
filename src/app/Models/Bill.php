<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model{
	protected $table= 'bills';
	protected $fillable = 	[
							'orderId',
							];
	protected $dates =[
						'created_at',
						];
	public function orders(){
		return $this->belongsTo(Order::class, 'orderId');
	}
	public function revenueBills(){
		return $this->hasMany(revenueBill::class 'billId');
	}
}

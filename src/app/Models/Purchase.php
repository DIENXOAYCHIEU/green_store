<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model{
	use SoftDeletes;

	protected $table = 'purchases';
	protected $fillable = [
							'orderId',
							];
	protected $dates =[
						'created_at',
						'deleted_at',
						'updated_at',
						];
	public function revenuePurchases(){
		return $this->hasMany(RevenuePurchase::class, 'purchaseId');
	}
	public function orders(){
		return $this->belongsTo(Order::clsas, 'orderId');
	}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model{
	use SoftDeletes;

	protected $table = 'purchases';
	protected $fillable = [
							'order_id',
							];
	protected $dates = [
						'deleted_at',
						'created_at',
						'updated_at',
						];
	public function revenuePurchases(){
		return $this->hasMany(RevenuePurchase::class, 'purchase_id');
	}
	public function orders(){
		return $this->belongsTo(Order::clsas, 'order_id');
	}
}

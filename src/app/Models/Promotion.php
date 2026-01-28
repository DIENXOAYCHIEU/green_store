<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model{
	use SoftDeletes;

	protected $table = 'promotions';
	protected $fillable = [
							'code',
							'discount',
							'name',
							'isActive',
							];
	protected $dates =[
					'created_at',
					'deleted_at',
					'updated_at',
					];
	public function orders(){
		return $this->hasMany(Order::class, 'promotionId');
	}
}

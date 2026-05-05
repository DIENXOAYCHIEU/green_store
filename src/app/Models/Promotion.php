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
							'is_active',
							];
	protected $dates = [
						'deleted_at',
						'created_at',
						'updated_at',
						];
	public function orders(){
		return $this->hasMany(Order::class, 'promotion_id');
	}
}

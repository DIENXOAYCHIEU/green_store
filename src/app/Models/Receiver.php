<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receiver extends Model{
	use SoftDeletes;

	protected $table= 'receivers';
	protected $fillable = [
							'fullname',
							'phone',
							'province',
							'district',
							'ward',
							'full_address',
							'is_supplier',
							];
	protected $dates = [
						'deleted_at',
						'created_at',
						'updated_at',
						];
	public function orders(){
		return $this->hasMany(Order::class, 'receiver_id');
	}
}

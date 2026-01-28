<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sender extends Model{
	use SoftDeletes;

	protected $table= 'senders';
	protected $fillable = [
							'fullname',
							'phone',
							'province',
							'district',
							'ward',
							'fullAddress',
							'isSupplier',
							];
	protected $dates =[
						'created_at',
						'deleted_at',
						'updated_at',
						];
	public function orders(){
		return $this->hasMany(Order::class, 'senderId');
	}
}

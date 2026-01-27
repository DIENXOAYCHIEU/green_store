<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model{
	use SoftDeletes;

	protected $table = ['accounts'];
	protected $fillable =   [
								'username',
								'phone',
								'email',
								'password',
								'avatar',
								'roleId',
							];
	protected $dates = [
						'deleted_at',
						'created_at',
						'updated_at',
						];
	protected $hidden = [
						'password',
						];

	public function roles(){
		return $this->belongsTo(Role::class, 'roleId');
	}

	public function revenueAccounts(){
		return $this->hasMany(revenueAccount::class, 'accountId');
	}
}

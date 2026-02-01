<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Authenticatable{
	use SoftDeletes;
	use HasFactory;
	
	protected $table = 'accounts';
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
		return $this->belongsTo(Role::class, 'role_id');
	}

	public function revenueAccounts(){
		return $this->hasMany(revenueAccount::class, 'account_id');
	}
}

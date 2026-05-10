<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable implements MustVerifyEmail{
	use SoftDeletes;
	use HasFactory;
	use Notifiable;
	protected $table = 'accounts';
	protected $fillable =   [
								'username',
								'phone',
								'email',
								'password',
								'email_verified_at',
								'avatar',
								'role_id',
								'is_locked',
							];
	protected $dates = [
						'deleted_at',
						'created_at',
						'updated_at',
						];
	protected $hidden = [
						'password',
						'remember_token',
						];

	public function roles(){
		return $this->belongsTo(Role::class, 'role_id');
	}

	public function revenueAccounts(){
		return $this->hasMany(revenueAccount::class, 'account_id');
	}

	public function reviews(){
		return $this->hasMany(Review::class, 'account_id');
	}
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

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

	public function getAvatarUrlAttribute()
	{
		$avatar = trim((string) $this->avatar);
		$defaultAvatar = 'https://res.cloudinary.com/dl5najcrb/image/upload/v1775904289/default-avatar-icon-of-social-media-user-vector_znbehh.jpg';

		if ($avatar === '') {
			return $defaultAvatar;
		}

		if (Str::startsWith($avatar, ['http://', 'https://'])) {
			return $avatar;
		}

		if (Str::startsWith($avatar, 'storage/') && file_exists(public_path($avatar))) {
			return asset($avatar);
		}

		if (Str::startsWith($avatar, 'avatars/') && file_exists(public_path('storage/' . $avatar))) {
			return asset('storage/' . $avatar);
		}

		if (file_exists(public_path($avatar))) {
			return asset($avatar);
		}

		if (file_exists(public_path('storage/' . $avatar))) {
			return asset('storage/' . $avatar);
		}

		return $defaultAvatar;
	}
}

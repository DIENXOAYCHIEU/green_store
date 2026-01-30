<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model{
	use SoftDeletes;
	const USER = 'user';
	const ADMIN = 'admin';
	
	protected $table = 'roles';
	protected $fillable = [
							'name',
							];
	protected $dates = [
						'deleted_at',
						'created_at',
						'updated_at',
						];
	public function accounts(){
		return $this->hasMany(Account::class, 'role_id');
	}
}

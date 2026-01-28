<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevenueAccount extends Model{

	protected $table = 'revenue_accounts';
	protected $fillable = [
							'accountId',
							];
	protected $dates =[
						'created_at',
						];
	public function accounts(){
		return $this->belongsTo(Account::class, 'accountId');
	}
}

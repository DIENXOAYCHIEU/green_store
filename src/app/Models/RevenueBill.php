<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevenueBill extends Model{

	protected $table = 'revenue_bills';
	protected $fillable = [
							'bill_id',
							];
	protected $dates =[
						'created_at',
						];
	public function accounts(){
		return $this->belongsTo(Bill::class, 'bill_id');
	}
}

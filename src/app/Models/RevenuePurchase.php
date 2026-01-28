<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevenuePurchase extends Model{

	protected $table = 'revenue_purchases';
	protected $fillable = [
							'purchaseId',
							];
	protected $dates =[
						'created_at',
						];
	public function accounts(){
		return $this->belongsTo(Purchase::class, 'purchaseId');
	}
}

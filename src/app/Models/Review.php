<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Review extends Model{
	use SoftDeletes;
	use HasFactory;

	protected $table = 'reviews';
	protected $fillable = [
							'content',
							'product_id',
							'account_id',
							];
	protected $dates = [
						'deleted_at',
						'created_at',
						'updated_at',
						];
	public function accounts(){
		return $this->belongsTo(Account::class, 'account_id');
	}

	public function products(){
		return $this->belongsTo(Product::class, 'product_id');
	}

}

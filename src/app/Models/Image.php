<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Image extends Model{

	use SoftDeletes;

	protected $table = ['images'];
	protected $fillable = [
							'productId',
							'path',
							'alt',
						];
	protected $dates = [
						'deleted_at',
						'created_at',
						'updated_at',
						];
	public function products(){
		return $this->belongsTo(Product::class, 'productId');
	}
}

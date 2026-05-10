<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Image extends Model{

	use SoftDeletes;
	use HasFactory;

	protected $table = 'images';
	protected $fillable = [
							'product_id',
							'path',
							'alt',
						];
	protected $dates = [
						'deleted_at',
						'created_at',
						'updated_at',
						];
	public function products(){
		return $this->belongsTo(Product::class, 'product_id');
	}
}

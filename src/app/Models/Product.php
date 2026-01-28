<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model{
	use SoftDeletes;

	protected $table = 'products';
	protected $fillable = [
							'name',
							'price',
							'picture',
							'weight',
							'description',
							'discount',
							'totalPrice',
							'categoryId',
							'inventoryQuantity',
							'soldQuantity',
							'isdelete',
							];
	protected $dates =[
						'created_at',
						'deleted_at',
						'updated_at',
						];
	public function categories(){
		return $this->belongsTo(Category::class, 'categoryId');
	}
	public function images(){
		return $this->hasMany(Image::class, 'productId');
	}
	public function orderDetails(){
		return $this->hasMany(OrderDetail::class, 'productId');
	}
}

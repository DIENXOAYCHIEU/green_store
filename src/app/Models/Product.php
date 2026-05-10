<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model{
	use SoftDeletes;
	use HasFactory;
	
	protected $table = 'products';
	protected $fillable = [
							'name',
							'price',
							'picture',
							'weight',
							'description',
							'discount',
							'total_price',
							'category_id',
							'inventory_quantity',
							'sold_quantity',
							];
	protected $dates = [
						'deleted_at',
						'created_at',
						'updated_at',
						];
	public function categories(){
		return $this->belongsTo(Category::class, 'category_id');
	}
	public function images(){
		return $this->hasMany(Image::class, 'product_id');
	}
	public function orderDetails(){
		return $this->hasMany(OrderDetail::class, 'product_id');
	}
	public function reviews(){
		return $this->hasMany(Review::class, 'product_id');
	}
}

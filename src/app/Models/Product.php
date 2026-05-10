<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;


class Product extends Model{
	use SoftDeletes;
	use HasFactory;
	
	protected $table = 'products';
	protected $fillable = [
							'name',
							'price',
							'picture',
							'description',
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

	public function getPictureUrlAttribute()
	{
		$picture = trim((string) $this->picture);

		if ($picture === '') {
			return asset('images/default-product.png');
		}

		if (Str::startsWith($picture, ['http://', 'https://'])) {
			return $picture;
		}

		if (Str::startsWith($picture, 'storage/products/')) {
			$publicPath = 'products/' . basename($picture);
			if (file_exists(public_path($publicPath))) {
				return asset($publicPath);
			}
		}

		if (Str::startsWith($picture, 'storage/')) {
			if (file_exists(public_path($picture))) {
				return asset($picture);
			}
		}

		if (file_exists(public_path($picture))) {
			return asset($picture);
		}

		if (file_exists(public_path('storage/' . ltrim($picture, '/')))) {
			return asset('storage/' . ltrim($picture, '/'));
		}

		return asset('storage/' . ltrim($picture, '/'));
	}

	public function orderDetails(){
		return $this->hasMany(OrderDetail::class, 'product_id');
	}
	public function reviews(){
		return $this->hasMany(Review::class, 'product_id');
	}
}

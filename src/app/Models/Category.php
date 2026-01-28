<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model{

	use SoftDeletes;

	const RECYCLING = 'Tái chế';
	const INOX = 'inox';
	const NATURE = 'Thiên nhiên';
	
	protected $table = 'categories';
	protected $fillable = ['name',];
	protected $dates = [
						'deleted_at',
						'created_at',
						'updated_at',
						];
						
	public function products(){
		return $this->hasMany(Product::class, 'categoryId');
	}
}

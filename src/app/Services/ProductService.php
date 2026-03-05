<?php
namespace App\Services;
use App\Models\Product;

class ProductService{

	public function isQuantity(int $product_id, ?string $quantity=null){
		$product = Product::find($product_id);

		if (!($product && $quantity)) return false;
		if (!preg_match("/^[1-9]\d*$/", $quantity)) return false;
		if ($quantity<1 || $quantity > $product->inventory_quantity) return false;

		return true;

	}
}
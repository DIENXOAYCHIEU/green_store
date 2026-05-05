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

	public function getSortOptions(){
		return [
			['id'=>1,'name' => 'A-Z'],
			['id'=>2,'name' => 'Z-A'],
			['id'=>3,'name' => 'Giá giảm dần'],
			['id'=>4,'name' => 'Giá tăng dần'],
			['id'=>5,'name' => 'Mới nhất'],
			['id'=>6,'name' => 'Cũ nhất'],
		];
	}

	public function getProductsQueryBySort($selected_sort_option_id, $products){
		if ($selected_sort_option_id==1){
			return $products->orderBy('name', 'asc');
		}
		if ($selected_sort_option_id==2){
			return $products->orderBy('name', 'desc');
		}
		if ($selected_sort_option_id==3){
			return $products->orderBy('price', 'desc');
		}
		if ($selected_sort_option_id==4){
			return $products->orderBy('price', 'asc');
		}
		if ($selected_sort_option_id==5){
			return $products->orderBy('created_at', 'desc');
		}
		if ($selected_sort_option_id==6){
			return $products->orderBy('created_at', 'asc');
		}
		return $products;
	}

	public function getProductsQueryByCategory(array $selected_category_ids, $products){
		if (!empty($selected_category_ids)){
			$products->whereIn('category_id', $selected_category_ids);
		}
		return $products;
	}

	public function getProductsQueryByPrice(array $selected_price, $products){
		if( $selected_price['to']!==null && $selected_price['from']!==null ){
			$products->whereBetween('price', [$selected_price['from'], 
											$selected_price['to']]);
		}
		elseif ($selected_price['to']!==null){
			$products->where('price', '<=',$selected_price['to']);
		}
		elseif ($selected_price['from']!==null){
			$products->where('price', '>=',$selected_price['from']);
		}
		return $products;
	}

	public function getProductsQuery(array $selected_category_ids,
								array $selected_price,
								$selected_sort_option_id){
		$products = Product::query();
		$products = $this->getProductsQueryByCategory($selected_category_ids, $products);
		$products = $this->getProductsQueryByPrice($selected_price, $products);
		$products = $this->getProductsQueryBySort($selected_sort_option_id, $products);
		return $products;
	}

	public function isPrice($selected_price, $lowest, $highest){
		$from=$selected_price['from'];
		$to=$selected_price['to'];

		if ($from <= $to &&
			$from >= $lowest &&
			$to <= $highest){
			return true;
		}

		if ($from==null && $lowest<=$to && $to<=$highest){
			return true;
		}

		if ($to==null && $lowest<=$from && $from <=$highest){
			return true;
		}

		if ($to==null && $from==null){
			return true;
		}
		return false;
	}

}
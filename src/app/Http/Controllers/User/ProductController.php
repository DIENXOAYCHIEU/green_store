<?php

namespace App\Http\Controllers\User;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;
use App\Services\ProductService;

class ProductController extends Controller{
	public function __construct(
		private ProductService $service
	){}

	public function index(Request $request){
		$highest_price=Product::max('price');
		$lowest_price=Product::min('price');
		$categories = Category::all();
		$sort_options = $this->getSortOptions();

		$selected_category_ids= $request->input('selected_category_ids', []);
		$selected_price = [
			'from'=>$request->input('selected_price_from',null),
			'to'=>$request->input('selected_price_to',null),
		];
		$selected_sort_option_id = $request->input('selected_sort_option_id', null);
		if (! $this->validateSelectedPrice($selected_price,
								$lowest_price,
								$highest_price)){
			$selected_price['from'] = null;
			$selected_price['to'] = null;
		}
		$products=$this->getProductsQuery($selected_category_ids,
							$selected_price,
							$selected_sort_option_id)->paginate(8)->withQueryString();
		return view('user.product.index',
			[
			'highest_price'=>$highest_price,
			'lowest_price' =>$lowest_price,
			'products'=>$products,
			'categories'=> $categories,
			'sort_options'=>$sort_options,
			'selected_categories'=>Category::whereIn('id',$selected_category_ids)->get(),
			'selected_category_ids'=>$selected_category_ids,
			'selected_price'=>$selected_price,
			'selected_sort_option_id'=>$selected_sort_option_id,
			]);
	}

	// detail product
	public function show(Request $request, int $id){
		$product = Product::findOrFail($id);
		$reviews = Review::where('product_id', $id)
							->with('accounts')
							->orderBy('created_at', 'desc')
							->paginate(5);
		$detail_images=Image::where('product_id', $product->id)->get();
		return view('user.product.show', [
			'product'=>$product,
			'reviews' => $reviews,
			'detail_images'=>$detail_images,
		]);
	}

	// check out
	public function checkout(Request $request){
		$products_in_cart = $this->getFromCart($request);
		return view('user.product.checkout',[
			'products_in_cart'=>$products_in_cart,
		]);
	}

	// buy now
	public function buyNow(Request $request){
		$product_id = $request->input('product_id');
		$quantity = $request->input('quantity');
		if(!$this->service->isQuantity($product_id, $quantity)){
			return back()
					->withErrors([
						'quantity'=>'Số lượng không hợp lệ',
					])
					->withInput();
		}
		$products_in_cart = Product::find($product_id);
		$products_in_cart->quantity=$quantity;
		return view('user.product.checkout',[
			'products_in_cart' => $products_in_cart,
		]);
	}

	// sort option
	private function getSortOptions(){
		return [
			['id'=>1,'name' => 'A-Z'],
			['id'=>2,'name' => 'Z-A'],
			['id'=>3,'name' => 'Giá giảm dần'],
			['id'=>4,'name' => 'Giá tăng dần'],
			['id'=>5,'name' => 'Mới nhất'],
			['id'=>6,'name' => 'Cũ nhất'],
		];
	}

	// products by query
	private function getProductsQuery(array $selected_category_ids,
								array $selected_price,
								$selected_sort_option_id){
		$products = Product::query();
		$products = $this->getProductsQueryByCategory($selected_category_ids, $products);
		$products = $this->getProductsQueryByPrice($selected_price, $products);
		$products = $this->getProductsQueryBySort($selected_sort_option_id, $products);
		return $products;
	}

	// get by sort 
	private function getProductsQueryBySort($selected_sort_option_id, $products){
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
	// get by category
	private function getProductsQueryByCategory(array $selected_category_ids, $products){
		if (!empty($selected_category_ids)){
			$products->whereIn('category_id', $selected_category_ids);
		}
		return $products;	
	}
	// get by price
	private function getProductsQueryByPrice(array $selected_price, $products){
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

	// validation filter price
	private function validateSelectedPrice($selected_price, $lowest, $highest){
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

	// pagination
	private function paginate($products, $max=3){
		$start=max($products->currentPage()-1,1);
		$end=min($start + $max - 1,$products->lastPage()); 
		return [
			'start'=>$start,
			'end'=>$end,
		];
	}

	// get products from cart
	private function getFromCart(Request $request){
		$cart= json_decode($request->input('cart-input'), true);
		$product_ids = array_column($cart, 'id');

		$products = Product::whereIn('id', $product_ids)->get();
		$products_in_cart = $products->map(function($product) use ($cart){
			$item = collect($cart)->firstWhere('id', $product->id);
			$product->quantity=$item['quantity'];
			return $product;
		});
		return $products_in_cart;
	}
}

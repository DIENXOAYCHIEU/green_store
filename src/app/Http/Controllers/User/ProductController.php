<?php

namespace App\Http\Controllers\User;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

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
							$selected_sort_option_id);
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

	public function create(){
		return view('user.product.create');
	}

	public function store(Request $request){
		$validated = $this->validateProduct($request);

		Product::create($validated);
		return redirect()->route('product.index')
							->with('success', 'Product created successfully');
	}

	// detail product
	public function show(int $id){
		$product = Product::findOrFail($id);
		return view('user.product.show', ['product'=>$product]);
	}

	// form 
	public function edit(int $id){
		$product = Product::findOrFail($id);
		return view('user.product.edit', ['product'=>$product]);
	}

	public function update(Request $request, int $id){
		$product = Product::findOrFail($id);
		$validated = $this->validateProduct($request, $id);
		$product->update($validated);
		return redirect()->route('product.index')
							->with('success', 'Product updated successfully');
	}

	public function destroy(int $id){
		$product = Product::findOrFail($id);
		$product->delete();
		return redirect()->route('product.index')
						 ->with('success', 'Product deleted successfully');
	}


	// validation when create product
	private function validateProduct(Request $request, int $id = null){
		$validated = $request->validate([
								'name' => [
										'required','string',
										Rule::unique('products', 'name')->ignore($id),
											],
								'price' => 'required|numeric|min:0',
								'picture' => 'required|string',
								'weight' => 'required|integer|min:0',
								'description' => 'required|string',
								'discount' => 'required|numeric|min:0|max:100',
								'category_id' => 'required|exists:categories,id',
								'inventory_quantity' => 'required|integer|min:0',
								]);
		$validated['total_price'] = $validated['price'] - $validated['price']*$validated['discount']/100;
		return $validated;		
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
		$products = Product::orderBy('created_at', 'desc');
		$products = $this->getProductsQueryByCategory($selected_category_ids, $products);
		$products = $this->getProductsQueryByPrice($selected_price, $products);
		$products = $this->getProductsQueryBySort($selected_sort_option_id, $products);
		return $products;
	}

	// get by sort 
	private function getProductsQueryBySort($selected_sort_option_id, $products){
		if ($selected_sort_option_id==1){
			$products=$products->orderBy('name', 'asc');
		}
		elseif ($selected_sort_option_id==2){
			$products=$products->orderBy('name', 'desc');
		}
		elseif ($selected_sort_option_id==3){
			$products=$products->orderBy('price', 'desc');
		}
		elseif ($selected_sort_option_id==4){
			$products=$products->orderBy('price', 'asc');
		}
		elseif ($selected_sort_option_id==5){
			$products=$products->orderBy('created_at', 'desc');
		}
		elseif ($selected_sort_option_id==6){
			$products=$products->orderBy('created_at', 'asc');
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
}

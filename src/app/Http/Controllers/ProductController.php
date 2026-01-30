<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

	public function index(Request $request){
		$categories = Category::all();
		$sort_options = $this->getSortOptions();

		$selected_category_ids= $request->input('categories', []);
		$selected_price = [
			'from'=>$request->input('selected_price_from',null),
			'to'=>$request->input('selected_price_to',null),
		];
		$products=$this->getProductsQuery($selected_category_ids, $selected_price);
		return view('product.index',
			[
			'highest_price'=>$products->max('price'),
			'lowest_price' =>$products->min('price'),
			'products'=>$products->paginate(16),
			'categories'=> $categories,
			'sort_options'=>$sort_options,
			'selected_categories'=>Category::whereIn('id',$selected_category_ids)->get(),
			'selected_category_ids'=>$selected_category_ids,
			'selected_price'=>$selected_price,
			]);
	}

	public function create(){
		return view('product.create');
	}

	public function store(Request $request){
		$validated = $this->validation($request);

		Product::create($validated);
		return redirect()->route('product.index')
							->with('success', 'Product created successfully');
	}

	// detail product
	public function show(int $id){
		$product = Product::findOrFail($id);
		return view('product.show', ['product'=>$product]);
	}

	// form 
	public function edit(int $id){
		$product = Product::findOrFail($id);
		return view('product.edit', ['product'=>$product]);
	}

	public function update(Request $request, int $id){
		$product = Product::findOrFail($id);
		$validated = $this->validation($request, $id);
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


	// validate
	private function validation(Request $request, int $id = null){
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
	private function getProductsQuery(array $selected_category_ids, array $selected_price){
		$products = Product::orderBy('created_at', 'desc');

		if (!empty($selected_category_ids)){
			$products->whereIn('category_id', $selected_category_ids);
		}

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
}

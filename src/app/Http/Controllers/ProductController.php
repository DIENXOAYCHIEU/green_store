<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
	public function index(){
		$products = Product::orderBy('created_at', 'desc')->paginate(16);
		return view('product.index', ['products'=>$products]);
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
								'categoryId' => 'required|exists:categories,id',
								'inventoryQuantity' => 'required|integer|min:0',
								]);
		$validated['totalPrice'] = $validated['price'] - $validated['price']*$validated['discount']/100;
		return $validated;		
	}
}

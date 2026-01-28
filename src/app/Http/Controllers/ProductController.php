<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
	public function index(){
		$products = Product::orderBy('created_at', 'desc')->paginate(16);
		return view('product.index', ['products'=>$products]);
	}

	public function create(){
		//
	}

	public function store(Request $request){
		//
	}

	public function show(string $id){
		//
	}

	public function edit(string $id){
		//
	}

	public function update(Request $request, string $id){
		//
	}

	public function destroy(string $id){
		//
	}
}

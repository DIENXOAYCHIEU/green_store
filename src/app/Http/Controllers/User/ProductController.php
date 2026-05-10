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
		private ProductService $productService
	){}

	public function index(Request $request){
		$highest_price=Product::max('price');
		$lowest_price=Product::min('price');
		$categories = Category::all();
		$sort_options = $this->productService->getSortOptions();

		$selected_category_ids= $request->input('selected_category_ids', []);
		$selected_price = [
			'from'=>$request->input('selected_price_from',null),
			'to'=>$request->input('selected_price_to',null),
		];
		$selected_sort_option_id = $request->input('selected_sort_option_id', null);
		if (! $this->productService->isPrice($selected_price,
								$lowest_price,
								$highest_price)){
			$selected_price['from'] = null;
			$selected_price['to'] = null;
		}
		$products=$this->productService->getProductsQuery($selected_category_ids,
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

	public function checkout(Request $request)
	{
		$products_in_cart = $this->getFromCart($request);

		return view('user.product.checkout', [
			'products_in_cart' => $products_in_cart,
		]);
	}

	public function processCheckout(Request $request) {
		$request->validate([
			'receiver_name' => 'required|string|max:255',
			'receiver_phone' => 'required|string|max:20',
			'province' => 'required|string|max:255',
			'district' => 'required|string|max:255',
			'ward' => 'required|string|max:255',
			'full_address' => 'required|string',
			'note' => 'nullable|string',
			'cart-input' => 'required|json',
		]);

		$cartData = json_decode($request->input('cart-input'), true);
		$products_in_cart = $this->getFromCart($request);

		if ($products_in_cart->isEmpty()) {
			return back()->withErrors([`cart-${window.currentUserId}` => 'Giỏ hàng trống']);
		}

		// Calculate total price
		$totalPrice = 0;
		foreach ($products_in_cart as $product) {
			$totalPrice += $product->price * $product->quantity;
		}

		// Create receiver
		$receiver = \App\Models\Receiver::create([
			'fullname' => $request->receiver_name,
			'phone' => $request->receiver_phone,
			'province' => $request->province,
			'district' => $request->district,
			'ward' => $request->ward,
			'full_address' => $request->full_address,
			'is_supplier' => false,
		]);

		// Create order
		$order = \App\Models\Order::create([
			'account_id' => auth()->id(),
			'receiver_id' => $receiver->id,
			'total_price' => $totalPrice,
			'note' => $request->note,
			'status_id' => 1, // Pending payment
		]);

		// Create order details
		foreach ($products_in_cart as $product) {
			\App\Models\OrderDetail::create([
				'product_id' => $product->id,
				'order_id' => $order->id,
				'quantity' => $product->quantity,
				'total_price' => $product->price * $product->quantity,
			]);
		}

		// Clear cart from session
		session()->forget('cart');

		// Redirect to VNPay payment
		return redirect()->route('payment.vnpay', ['orderId' => $order->id]);
	}

	public function cart(){
		return view('user.cart.index');
	}

	public function buyNow(Request $request){
		$product_id = $request->input('product_id');
		$quantity = $request->input('quantity');
		if(!$this->productService->isQuantity($product_id, $quantity)){
			return back()
				->withErrors([
					'quantity'=>'Số lượng không hợp lệ',
				])
				->withInput();
		}
		$product = Product::findOrFail($product_id);
		$product->quantity = $quantity;
		$products_in_cart = collect([$product]);
		return view('user.product.checkout',[
			'products_in_cart' => $products_in_cart,
		]);
	}


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

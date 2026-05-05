<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product; // Gọi Model vào

class ProductController extends Controller {
    public function index() {
        // Lấy tất cả sản phẩm, kèm theo thông tin danh mục để hiển thị tên danh mục
        $products = Product::with('categories')->get(); 
        
        // Trả về giao diện admin và gửi kèm biến products
        return view('admin.products.index', compact('products'));
    }
}


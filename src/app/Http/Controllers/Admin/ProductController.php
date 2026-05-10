<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category; // Cần để chọn danh mục khi thêm/sửa
use Illuminate\Http\Request;

class ProductController extends Controller {
    
    // 1. Trang danh sách sản phẩm
    public function index(Request $request) {
        $query = Product::with('categories');

        // Tìm kiếm theo tên
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Lọc theo danh mục
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->latest()->paginate(10);
        $categories = Category::all(); // Lấy danh sách để hiện ở ô lọc

        return view('admin.products.index', compact('products', 'categories'));
    }

    // 2. Trang tạo mới
    public function create() {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // 3. Lưu sản phẩm mới
    public function store(Request $request) {
        // Nên validate dữ liệu trước để tránh các lỗi logic khác
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'weight' => 'required|numeric', // Bắt buộc nhập nếu DB không cho phép null
        ]);

        $data = $request->all();

        // Xử lý upload ảnh
        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('products', 'public');
        }

        // Tính toán total_price để đồng bộ với hàm update
        $data['total_price'] = $request->price * (1 - ($request->discount / 100));

        // Đảm bảo weight có giá trị (lấy từ form hoặc mặc định là 0 nếu bạn chưa sửa form)
        $data['weight'] = $request->input('weight', 0);

        Product::create($data);

        // Sửa lại redirect về đúng route admin.products.index
        return redirect()->route('admin.products.index')->with('success', 'Thêm mới thành công!');
    }

    // 4. Xem chi tiết
    public function show($id) {
    // Sử dụng with('categories') để lấy thông tin danh mục ngay khi tìm sản phẩm
        $product = Product::with('categories')->findOrFail($id);
        
        return view('admin.products.show', compact('product'));
    }

    // 5. Trang chỉnh sửa
    public function edit($id) { // Thay Product $product bằng $id để kiểm soát chắc chắn hơn
        $product = Product::findOrFail($id); // Nếu không tìm thấy sẽ trả về lỗi 404 thay vì null
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // 6. Cập nhật
    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);
        $data = $request->all();
        
        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('products', 'public');
        }
        
        // Tính toán lại giá tổng nếu cần
        $data['total_price'] = $request->price * (1 - ($request->discount / 100));

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Cập nhật thành công!');
    }

    // 7. Xóa sản phẩm
    public function destroy($id) { 
        $product = Product::findOrFail($id); // Tìm sản phẩm theo ID
        $product->delete();
        
        return redirect()->route('admin.products.index')->with('success', 'Đã xóa sản phẩm!');
    }
}
@extends('admin.home.homepage')

@section('title', 'Quản lý đơn hàng -')

@section('content')
<div class="order-management">
    <div class="page-header">
        <h2 class="page-title">Quản lý danh sách đơn hàng</h2>
    </div>

    <!-- Thanh lọc và Tìm kiếm -->
    <div class="filter-card">
        <form action="" method="GET" class="filter-form">
            <div class="search-group">
                <input type="text" placeholder="Tìm mã đơn, khách hàng, SĐT...">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="select-group">
                <select name="status">
                    <option value="">-- Trạng thái --</option>
                    {{-- Lặp từ bảng statuses --}}
                    <option value="1">Chờ xác nhận</option>
                    <option value="2">Đang xử lý</option>
                </select>
                <input type="date" name="date">
                <button type="button" class="btn-filter">Lọc dữ liệu</button>
            </div>
        </form>
    </div>

    <!-- Bảng dữ liệu chính -->
    <div class="table-container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Mã Đơn</th>
                    <th>Khách hàng</th>
                    <th>Giá gốc</th>
                    <th>Giảm giá</th>
                    <th>Tổng tiền</th>
                    <th>Khối lượng</th>
                    <th>Trạng thái</th>
                    <th>Ngày đặt</th>
                    <th>Thanh toán</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td><strong>#{{ $order->id }}</strong></td>
                    <td>
                        <div class="customer-info">
                            {{-- Đổi từ receiver thành receivers --}}
                            <p>{{ $order->receivers->fullname ?? 'N/A' }}</p>
                            <small>{{ $order->receivers->phone ?? '' }}</small>
                        </div>
                    </td>
                    <td>{{ number_format($order->price) }}đ</td>
                    <td class="text-red">-{{ number_format($order->price - $order->total_price) }}đ</td>
                    <td class="text-bold">{{ number_format($order->total_price) }}đ</td>
                    <td>{{ $order->total_weight }}g</td>
                    <td>
                        <span class="status-badge" style="background: #eee;">
                            {{ $order->statuses->name ?? 'N/A' }} {{-- Đổi thành statuses --}}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>
                        @if($order->bills->count() > 0) {{-- Kiểm tra collection vì bills là hasMany --}}
                            <button class="btn-invoice-link" onclick="openInvoice('{{ $order->id }}')">
                                <i class="fa-solid fa-file-invoice-dollar"></i> Xem hóa đơn
                            </button>
                        @else
                            <small>Chưa thanh toán</small>
                        @endif
                    </td>
                    <td class="actions">
                        {{-- Gọi hàm Ajax --}}
                        <button class="btn-action view" onclick="loadOrderDetail('{{ $order->id }}')">
                            <i class="fa-solid fa-circle-info"></i>
                        </button>
                        ...
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL 1: CHI TIẾT ĐƠN HÀNG -->
<div id="modalDetail" class="modal">
    <div class="modal-content modal-large">
        <div class="modal-header">
            {{-- Tiêu đề sẽ được cập nhật bởi JS: data.id --}}
            <h3 id="detailOrderId">Chi tiết đơn hàng</h3>
            <span class="close" onclick="closeModal('modalDetail')">&times;</span>
        </div>
        <div class="modal-body">
            <div class="info-grid">
                <div class="info-item">
                    <label><i class="fa-solid fa-user"></i> Người nhận:</label>
                    <div id="receiverContent">
                        {{-- Script sẽ chèn nội dung vào đây --}}
                    </div>
                </div>
                <div class="info-item">
                    <label><i class="fa-solid fa-truck"></i> Ghi chú đơn hàng:</label>
                    <p class="note-box" id="orderNote">--</p>
                </div>
            </div>
            <table class="detail-items">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Khối lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Script sẽ loop qua data.order_details và chèn <tr> vào đây --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL 2: HÓA ĐƠN (BILL) -->
<div id="modalInvoice" class="modal">
    <div class="modal-content modal-small">
        <div class="modal-header">
            <h3>HÓA ĐƠN THANH TOÁN</h3>
            <span class="close" onclick="closeModal('modalInvoice')">&times;</span>
        </div>
        <div class="modal-body print-area">
            <div class="bill-logo text-center">
                <i class="fa-solid fa-leaf"></i> GREEN LIFE STORE
            </div>
            <div class="bill-info" id="invoiceContent">
                {{-- Toàn bộ nội dung p, hr bên dưới sẽ được load động bởi hàm openInvoice --}}
            </div>
            <button class="btn-print" onclick="window.print()">
                <i class="fa-solid fa-print"></i> In hóa đơn
            </button>
        </div>
    </div>
</div>

<script>
    // 1. Hàm lấy chi tiết đơn hàng
    function loadOrderDetail(orderId) {
        $.get('/admin/orders/' + orderId, function(data) {
            // Điền tiêu đề
            $('#modalDetail h3').text('Chi tiết đơn hàng #' + data.id);
            
            // Thông tin người nhận
            let receiver = data.receivers;
            let receiverHtml = `
                <p>${receiver.fullname} - ${receiver.phone}</p>
                <p>Địa chỉ: ${receiver.full_address}, ${receiver.ward}, ${receiver.district}, ${receiver.province}</p>
            `;
            $('#modalDetail .info-item:first-child p').remove();
            $('#modalDetail .info-item:first-child').append(receiverHtml);
            
            // Ghi chú
            $('#modalDetail .note-box').text(data.note || "Không có ghi chú");

            // Danh sách sản phẩm
            let rows = '';
            let details = data.order_details || data.orderDetails;
            
            if(details) {
                details.forEach(function(detail) {
                // Ép kiểu dữ liệu về số, nếu null/undefined thì mặc định là 0
                let tPrice = parseFloat(detail.total_wrice) || 0;
                let qty = parseInt(detail.quantity) || 0;
                let tWeight = detail.total_weight || 0;

                // Tính đơn giá an toàn (tránh chia cho 0)
                let unitPrice = qty > 0 ? (tPrice / qty) : 0;

                rows += `
                    <tr>
                        <td>${detail.products ? detail.products.name : 'Sản phẩm đã xóa'}</td>
                        <td>${qty}</td>
                        <td>${tWeight}g</td>
                        <td>${new Intl.NumberFormat('vi-VN').format(unitPrice)}đ</td>
                        <td>${new Intl.NumberFormat('vi-VN').format(tPrice)}đ</td>
                    </tr>
                `;
            });
            }
            $('#modalDetail .detail-items tbody').html(rows);

            // Hiện Modal
            document.getElementById('modalDetail').style.display = 'block';
        }).fail(function() {
            alert("Không thể tải dữ liệu chi tiết đơn hàng!");
        });
    }

    // 2. Hàm lấy dữ liệu hóa đơn
    function openInvoice(orderId) {
        $.get('/admin/orders/' + orderId, function(data) {
            if (data.bills && data.bills.length > 0) {
                let bill = data.bills[0]; 
                
                $('#modalInvoice h3').text('HÓA ĐƠN #' + bill.id);
                $('#modalInvoice .bill-info').html(`
                    <p>Mã đơn hàng: <strong>#${data.id}</strong></p>
                    <p>Ngày lập hóa đơn: ${new Date(bill.created_at).toLocaleDateString('vi-VN')}</p>
                    <hr>
                    <p>Khách hàng: ${data.receivers ? data.receivers.fullname : 'N/A'}</p>
                    <p>Tổng thanh toán: <strong style="color:red; font-size:1.2rem;">${new Intl.NumberFormat().format(data.total_price)}đ</strong></p>
                    <p>Ghi chú: ${data.note || 'Không có'}</p>
                `);
                
                document.getElementById('modalInvoice').style.display = 'block';
            } else {
                alert("Đơn hàng này chưa có dữ liệu hóa đơn!");
            }
        }).fail(function() {
            alert("Không thể kết nối đến máy chủ!");
        });
    }

    // 3. Các hàm đóng/mở chung
    function closeModal(modalId) { 
        document.getElementById(modalId).style.display = 'none'; 
    }
    
    window.onclick = function(event) {
        if (event.target.className === 'modal') { 
            event.target.style.display = 'none'; 
        }
    }
</script>
@endsection
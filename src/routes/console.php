<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;
use App\Models\Order;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Chạy mỗi giờ một lần để quét các đơn hàng quá hạn
Schedule::call(function () {
    $expiryTime = now()->subHours(24); // Quy định 24 giờ
    
    // Tìm đơn hàng: Chờ xác nhận (status_id = 1) AND Quá 24h AND Chưa thanh toán (không có bill)
    $expiredCount = Order::where('status_id', 1)
        ->where('created_at', '<', $expiryTime)
        ->whereDoesntHave('bills')
        ->update(['status_id' => 5]); // Cập nhật thành Đã hủy (status_id = 5)

    // (Tùy chọn) Ghi log để kiểm tra
    if ($expiredCount > 0) {
        Log::info("Hệ thống đã tự động hủy $expiredCount đơn hàng quá hạn.");
    }
})->everyMinute();


// php artisan schedule:run 
// dùng để test ngay lập tức

// php artisan schedule:work
// dùng để chạy liên tục, tự động quét theo lịch đã định
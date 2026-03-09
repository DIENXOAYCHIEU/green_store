<div class="flex text-sm border-b" id="order-tabs">

    <button data-status=""
        class="tab px-6 py-3 border-b-2 border-green-500 text-green-600 font-semibold cursor-pointer">
        Tất cả
    </button>

    @foreach($statuses as $status)

    <button data-status="{{ $status->id }}"
        class="tab px-6 py-3 hover:text-green-600 cursor-pointer">

        @switch($status->id)
            @case(1) Chờ thanh toán @break
            @case(2) Vận chuyển @break
            @case(3) Đã hủy @break
            @case(4) Hoàn thành @break
        @endswitch

    </button>

    @endforeach

</div>
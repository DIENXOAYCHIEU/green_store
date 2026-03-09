let page = 1;
let lastPage = null;
let loading = false;
let status = "";
let search = "";
const baseProductImage = "{{ asset('storage/products') }}/";

async function loadOrders() {
    if (loading) return;
    if (lastPage && page > lastPage) return;

    loading = true;

    const container = document.getElementById("orders-container");

    container.insertAdjacentHTML("beforeend", skeleton());
    container.insertAdjacentHTML("beforeend", skeleton());

    const res = await fetch(
        `/purchase/orders?page=${page}&status=${status}&search=${search}`,
    );
    const data = await res.json();

    lastPage = data.last_page;

    container.querySelectorAll(".animate-pulse").forEach((el) => el.remove());

    renderOrders(data.data);

    page++;
    loading = false;
}

const observer = new IntersectionObserver(
    (entries) => {
        if (entries[0].isIntersecting) {
            loadOrders();
        }
    },
    {
        rootMargin: "600px",
    },
);

observer.observe(document.getElementById("scroll-trigger"));

loadOrders();

const exchangeCategoryName = (categoryId) => {
    switch (categoryId) {
        case 1:
            return "Tái chế";
            break;
        case 2:
            return "Inox";
            break;
        case 3:
            return "Tự nhiên";
            break;
        default:
            return "Mặc định";
            break;
    }
};

const exchangeStatusName = (statusId) => {
    switch (statusId) {
        case 1:
            return "Chờ thanh toán";
            break;
        case 2:
            return "Vận chuyển";
            break;
        case 3:
            return "Đã hủy";
            break;
        case 4:
            return "Hoàn thành";
            break;
        default:
            return "";
            break;
    }
};

function renderOrders(orders) {
    const container = document.getElementById("orders-container");

    if (!orders || orders.length === 0) {
        const html = `
			<div class="flex flex-col items-center py-20 text-gray-500">

				<i class='bx bx-package text-6xl mb-3'></i>

				<p class="text-lg">
					Bạn chưa có đơn hàng nào
				</p>

			</div>
		`;

        container.insertAdjacentHTML("beforeend", html);
        return;
    }

    let html = "";

    orders.forEach((order) => {
        let productsHTML = "";

        order.order_details.forEach((detail) => {
            const price = Number(detail.total_price ?? 0);

            productsHTML += `
				<div class="flex gap-3 py-3 cursor-pointer">
				<img src="${baseProductImage}${detail.products?.picture ?? ""}"
				class="w-16 h-16 object-cover rounded border">

				<div class="flex-1">

				<p class="font-medium text-sm">
				${detail.products?.name ?? ""}
				</p>

				<p class="text-sm text-gray-500">
				Phân loại: ${exchangeCategoryName(detail.products.category_id)}
				</p>

				<p class="text-xs text-gray-500">
				x${detail.quantity}
				</p>

				</div>

				<div class="text-red-500 font-semibold text-sm">
				₫${price.toLocaleString("vi-VN")}
				</div>

				</div>
			`;
        });

        const total = Number(order.total_price ?? 0);
        const date = new Date(order.created_at).toLocaleString("vi-VN");

        html += `
			<div class="bg-white rounded-lg shadow-sm">

			<div class="p-4">

			<div class="flex justify-between items-center mb-3">

			<div class="flex items-center gap-2">

			<span class="bg-red-500 text-white text-xs px-2 py-1 rounded">
			Yêu thích
			</span>

			<p class="font-semibold">
			Green Store Official
			</p>

			</div>

			<span class="text-green-600 font-semibold">
			${exchangeStatusName(order.statuses?.id)}
			</span>

			</div>

			${productsHTML}

			<div class="flex justify-between items-center mt-4 border-t pt-4">

			<p class="text-sm text-gray-600">
			Ngày mua: ${date}
			</p>

			<p class="text-sm text-gray-600">
			Thành tiền:
			<span class="text-red-500 text-lg font-semibold">
			${total.toLocaleString("vi-VN")}đ
			</span>
			</p>

			</div>

			</div>

			</div>
		`;
    });

    container.insertAdjacentHTML("beforeend", html);
}

function skeleton() {
    return `
				<div class="bg-white p-4 rounded shadow animate-pulse">

				<div class="flex justify-between mb-4">
				<div class="h-4 w-40 bg-gray-200 rounded"></div>
				<div class="h-4 w-20 bg-gray-200 rounded"></div>
				</div>

				<div class="flex gap-3 mb-3">
				<div class="w-16 h-16 bg-gray-200 rounded"></div>
				<div class="flex-1">
				<div class="h-4 bg-gray-200 rounded mb-2"></div>
				<div class="h-3 w-20 bg-gray-200 rounded"></div>
				</div>
				</div>

				</div>
			`;
}

// xử lý status tabs
document.querySelectorAll(".tab").forEach((tab) => {
    tab.addEventListener("click", () => {
        // highlight tab
        document.querySelectorAll(".tab").forEach((t) => {
            t.classList.remove(
                "border-b-2",
                "border-green-500",
                "text-green-600",
                "font-semibold",
            );
        });

        tab.classList.add(
            "border-b-2",
            "border-green-500",
            "text-green-600",
            "font-semibold",
        );

        // đổi status
        status = tab.dataset.status;

        // reset infinite scroll
        page = 1;
        lastPage = null;

        const container = document.getElementById("orders-container");
        container.innerHTML = "";

        loadOrders();
    });
});

// xử lý search bar
const searchInput = document.getElementById("order-search");

searchInput.addEventListener("keydown", function (e) {
    if (e.key === "Enter") {
        e.preventDefault();

        search = this.value;

        page = 1;
        lastPage = null;

        document.getElementById("orders-container").innerHTML = "";

        loadOrders();
    }
});

import {countCart} from './countCart.js';

function renderProductsCart(){
	let products = JSON.parse(sessionStorage.getItem('cart') || '[]');
	let cartContainer = document.getElementById('cart-container');
	let checkoutBtn = document.getElementById('checkout-btn');
	let cartBtn = document.getElementById('cart-button');

	if(!cartContainer) return;
	
	countCart(products);
	if (products.length===0){
		cartContainer.innerHTML = `
		<p class="p-4 text-gray-500 italic text-[1.3rem]">Giỏ hàng trống</p>
		`;
		checkoutBtn.innerHTML=``;
		return;
	}

	let rowData= getRows(products);
	let total = rowData.total;

	let head=getHead();
	let rows=rowData.rows;
	let foot=getFoot(total);

	cartContainer.innerHTML=`
		${head}
		${rows}
		${foot}
	`;
	checkoutBtn.innerHTML=`
		<button type="submit" form="cart-form" id="checkout-submit" class="text-white bg-blue-600 p-2 rounded-[0.5rem] font-bold cursor-pointer w-[15rem]">THANH TOÁN</button>
	`;
}

function getRows(products){
	let total=0;
	let rows = products.map(product=>{
		let subTotal = product.total_price * product.quantity;
		total+=subTotal;
		return `
		<tr>
			<td class="border border-gray-500 p-2 flex justify-center">
				<img class="h-[5rem] w-[5rem]" src="/storage/${product.picture}">
			</td>
			<td class="border border-gray-500 p-2">${product.name}</td>
			<td class="border border-gray-500 p-2 line-through text-gray-500">${formatPrice(product.price)}</td>
			<td class="border border-gray-500 p-2">${formatPrice(product.total_price)}</td>
			<td class="border border-gray-500 p-2">
				<div class="flex flex-row justify-center items-center hover:border-2 rounded-[0.6rem]">
					<span data-id="${product.id}" class="decrease-qty cursor-pointer w-[2rem] h-[2rem] flex items-center justify-center">
						<i class='text-[1.6rem] bx bx-minus'></i>
					</span>
					<input data-id="${product.id}" class="change-qty w-[3rem] h-[3rem] text-center spinner-none" type="number" name="" min="1" value="${product.quantity}">
					<span data-id="${product.id}" class="increase-qty cursor-pointer w-[2rem] h-[2rem] flex items-center justify-center">
						<i class='text-[1.6rem] bx bx-plus' ></i>
					</span>
				</div>
			</td>
			<td class="border border-gray-500 p-2">${formatPrice(subTotal)}</td>
			<td class="border border-gray-500 p-2">
				<i data-id='${product.id}' class='remove-from-cart cursor-pointer text-red-600 text-[1.5rem] bx bx-trash'></i>
			</td>
		</tr>
		`;
	}).join('');
	return {
		rows:rows,
		total:total
	};
}

function getHead(){
	let head=`
		<table class="table-auto text-center border-collapse border border-gray-500 w-2/3">
			<thead>
				<tr>
					<th class="border border-gray-500 p-2" colspan="2">Sản phẩm</th>
					<th class="border border-gray-500 p-2">Giá gốc</th>
					<th class="border border-gray-500 p-2">Giá bán</th>
					<th class="border border-gray-500 p-2">Số lượng</th>
					<th class="border border-gray-500 p-2">Tổng cộng</th>
					<th class="border border-gray-500 p-2">Thao tác</th>
				</tr>
			</thead>
			<tbody>
	`;
	return head;
}

function getFoot(total){
	let foot=`
				<tr>
					<td class="border border-gray-500 p-2 font-bold text-[1.2rem]" colspan="5">Thành tiền:</td>
					<td class="border border-gray-500 p-2 font-bold text-[1.2rem]" colspan="2">${formatPrice(total)}</td>
				</tr>
			</tbody>
		</table>
	`;
	return foot;
}

function formatPrice(price){
	return price.toLocaleString('vi-VN') + ' ₫';
}

// remmove from cart

function removeFromCart(productId){
	let products = JSON.parse(sessionStorage.getItem('cart'));
	products = products.filter(p=>p.id!==Number(productId));
	sessionStorage.setItem('cart', JSON.stringify(products));
}

function handleRemoveFromCart(e){
	let btn = e.target.closest('.remove-from-cart');
	if(btn){
		removeFromCart(btn.dataset.id);
		renderProductsCart();
	}
}

// decrease quantity

function decreaseQty(productId){
	let products = JSON.parse(sessionStorage.getItem('cart'));
	let product = products.find(p=>p.id===Number(productId));
	if (product && product.quantity>1){
		product.quantity-=1;
		sessionStorage.setItem('cart', JSON.stringify(products));
	}
}

function handleDecreaseQty(e){
	let btn = e.target.closest('.decrease-qty');
	if(btn){
		decreaseQty(btn.dataset.id);
		renderProductsCart();
	}
}

// increase quantity

function increaseQty(productId){
	let products = JSON.parse(sessionStorage.getItem('cart'));
	let product = products.find(p=>p.id===Number(productId));
	if (product && product.quantity<product.inventory_quantity){
		product.quantity+=1;
		sessionStorage.setItem('cart', JSON.stringify(products));
	}	
}

function handleIncreaseQty(e){
	let btn = e.target.closest('.increase-qty');
	if(btn){
		increaseQty(btn.dataset.id);
		renderProductsCart();		
	}
}

// input change quantity
function changeQty(productId, quantity){
	let products = JSON.parse(sessionStorage.getItem('cart'));
	let product = products.find((p)=>p.id===Number(productId));

	if (!Number.isInteger(quantity) || !product){
		return;
	}

	product.quantity = quantity;
	if(product.quantity>product.inventory_quantity){
		product.quantity=product.inventory_quantity;
	}
	else if (product.quantity<1){
		product.quantity=1;
	}
	sessionStorage.setItem('cart', JSON.stringify(products));
} 

function handleChangeQty(e){
	let btn = e.target.closest('.change-qty');
	if(btn){
		changeQty(btn.dataset.id, Number(btn.value));
		renderProductsCart();
	}
}
function handlerCart() {
	document.addEventListener('click', function(e){
		handleDecreaseQty(e);
		handleIncreaseQty(e);
		handleRemoveFromCart(e);
	});
	document.addEventListener('change', function(e){
		handleChangeQty(e);
	});
}

handlerCart();
renderProductsCart();

export {renderProductsCart};

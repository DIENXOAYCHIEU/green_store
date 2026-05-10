function countCart(products){
	let cartBtn = document.getElementById('cart-button');
	let cartCount = document.getElementById('cart-count');
	
	// Calculate total items (sum of all quantities)
	const totalItems = products.reduce((total, product) => total + (product.quantity || 0), 0);

	if (cartBtn){
		if (totalItems > 0){
			if(totalItems < 100){
				cartBtn.innerHTML=`
					<i class='text-[1.5rem] md:text-[2.5rem] bx bx-cart'></i>
					<span class="bg-orange-600 pl-1 pr-1 rounded-[0.3rem] text-[0.5rem] md:text-[1rem] text-white z-2 font-bold absolute right-0 top-0 translate-x-[50%] md:translate-x-[10%]">${totalItems}</span>
				`;
			}
			else{
				cartBtn.innerHTML=`
					<i class='text-[1.5rem] md:text-[2.5rem] bx bx-cart'></i>
					<span class="bg-orange-600 pl-1 pr-1 rounded-[0.3rem] text-[0.5rem] md:text-[1rem] text-white z-2 font-bold absolute right-0 top-0 translate-x-[50%] md:translate-x-[10%]">99+</span>
				`;
			}
		}
		else{
			cartBtn.innerHTML=`
				<i class='text-[1.5rem] md:text-[2.5rem] bx bx-cart'></i>
			`;
		}
	}

	// Update cart count in header
	if (cartCount) {
		cartCount.textContent = totalItems;
	}
}

// Auto-detect cart count on page reload
document.addEventListener('DOMContentLoaded', function() {
	try {
		const cart = JSON.parse(sessionStorage.getItem(`cart-${window.currentUserId}`) || '[]');
		countCart(cart);
	} catch (error) {
		console.error('Error loading cart on page reload:', error);
		countCart([]);
	}
});

export {countCart};
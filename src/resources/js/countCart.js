function countCart(products){
	let cartBtn = document.getElementById('cart-button');
	if (cartBtn){
		if (products.length>0){
			cartBtn.innerHTML=`
				<i class='text-[2.5rem] bx bx-cart'></i>
				<span class="text-red-600 z-2 font-bold absolute right-0 top-0">${products.length}</span>
			`;
		}
		else{
			cartBtn.innerHTML=`
				<i class='text-[2.5rem] bx bx-cart'></i>
			`;
		}
	}
}

export {countCart};
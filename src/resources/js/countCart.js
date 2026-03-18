function countCart(products){
	let cartBtn = document.getElementById('cart-button');
	if (cartBtn){
		if (products.length>0){
			if(products.length<100){
				cartBtn.innerHTML=`
					<i class='text-[1.5rem] md:text-[2.5rem] bx bx-cart'></i>
					<span class="bg-orange-600 pl-1 pr-1 rounded-[0.3rem] text-white z-2 font-bold absolute right-0 top-0 translate-x-[50%]">${products.length}</span>
				`;
			}
			else{
				cartBtn.innerHTML=`
					<i class='text-[1.5rem] md:text-[2.5rem] bx bx-cart'></i>
					<span class="bg-orange-600 pl-1 pr-1 rounded-[0.3rem] text-white z-2 font-bold absolute right-0 top-0 translate-x-[50%]">99+</span>
				`;				
			}
		}
		else{
			cartBtn.innerHTML=`
				<i class='text-[1.5rem] md:text-[2.5rem] bx bx-cart'></i>
			`;
		}
	}
}

export {countCart};
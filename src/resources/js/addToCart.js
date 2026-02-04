import {renderProductsCart} from './renderProductsInCart';

let addToCartBtn = document.getElementById('add-to-cart');
if (addToCartBtn){
	addToCartBtn.addEventListener('click', function(e){
		let quantityInput = document.getElementById('quantiy');
		let quantity = parseInt(quantityInput.value) || 1;
		let product = JSON.parse(addToCartBtn.dataset.product);

		product.quantity = quantity;
		let productsInCart=JSON.parse(sessionStorage.getItem('cart')) || [];

		if ( 1 <=product.quantity && 
			product.quantity<= product.inventory_quantity){

			productsInCart=checkExist(productsInCart, product);
			sessionStorage.setItem('cart', JSON.stringify(productsInCart));
			alerAddSuccessfully();
		}
		else
			alert('Số lượng không hợp lệ');

		renderProductsCart();
	});
}

function checkExist(products, product){
	let existingProduct = products.find(p => p.id === product.id);

	if(existingProduct){
		existingProduct.quantity += product.quantity;
		if(existingProduct.quantity > product.inventory_quantity)
			existingProduct.quantity = product.inventory_quantity;
	}
	else
		products.push(product);
	return	products;
}

function alerAddSuccessfully(){
	let notify = document.getElementById('cart-success');
	if (!notify)
		return;

	notify.innerHTML=`
		<p id='cart-success-content' class="p-2 bg-white text-green-600 border-2 rounded-[0.5rem] border-green-600 font-bold">Thêm giỏ hàng thành công</p>
	`;
	document.getElementById('cart-success-content').classList.add('slide-down');
	setTimeout(()=>{
		notify.innerHTML=``;
	},1500);
}
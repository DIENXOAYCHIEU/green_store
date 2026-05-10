import {renderProductsCart} from './renderProductsInCart';
import {countCart} from './countCart';
import {showPopup} from './showPopup';

function initAddToCart() {

	const addToCartBtn =
		document.getElementById('add-to-cart');

	if (!addToCartBtn) return;


	const cartKey = `cart-${window.currentUserId}`;

	addToCartBtn.addEventListener('click', function(e){
		e.preventDefault();
		const quantityInput = document.getElementById('quantity');
		const quantity = parseInt(quantityInput?.value, 10) || 1;

		const product = JSON.parse(
			addToCartBtn.dataset.product || '{}'
		);

		product.quantity = quantity;

		const productsInCart = JSON.parse(
			sessionStorage.getItem(cartKey) || '[]'
		);

		if (
			quantity >= 1 &&
			quantity <= (product.inventory_quantity ?? Infinity)
		){

			const updatedCart =
				checkExist(productsInCart, product);

			sessionStorage.setItem(
				cartKey,
				JSON.stringify(updatedCart)
			);

			// Update cart count
			countCart(updatedCart);

			alertAddSuccessfully();

		}else{

			alert('Số lượng không hợp lệ');
		}
		renderProductsCart(window.currentUserId);
	});
}

function checkExist(products, product){
	const existingProduct = products.find(p => p.id === product.id);

	if(existingProduct){
		existingProduct.quantity += product.quantity;
		if(existingProduct.quantity > (product.inventory_quantity ?? Infinity)) {
			existingProduct.quantity = product.inventory_quantity;
		}
	} else {
		products.push(product);
	}
	return products;
}

function alertAddSuccessfully(){
	showPopup('Thêm vào giỏ hàng thành công', 'success', 3000);
}

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initAddToCart);
} else {
	initAddToCart();
}

let cartInput = document.getElementById('cart-input');
let cartForm = document.getElementById('cart-form');
if (cartForm && cartInput){
	cartForm.addEventListener('submit', function(){
		let cart = JSON.parse(sessionStorage.getItem('cart') || '[]');
		let temp = cart.map(c=>({id: c.id, quantity: c.quantity}));
		cartInput.value=JSON.stringify(temp);
		console.log(cartInput.value);
	});
}
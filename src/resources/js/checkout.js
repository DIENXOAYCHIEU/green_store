function initCartForm() {
	const cartInput = document.getElementById('cart-input');
	const cartForm = document.getElementById('cart-form');

	if (!cartForm || !cartInput) {
		return;
	}

	cartForm.addEventListener('submit', function() {
		const cart = JSON.parse(sessionStorage.getItem(`cart-${window.currentUserId}`) || '[]');
		const temp = cart.map(c => ({ id: c.id, quantity: c.quantity }));
		cartInput.value = JSON.stringify(temp);
	});
}

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initCartForm);
} else {
	initCartForm();
}
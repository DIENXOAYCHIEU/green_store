let cartButton = document.getElementById('cart-button');
if (cartButton){
	let popup=	document.getElementById('cart-popup');
	let cartClose = document.getElementById('cart-close');
	cartButton.addEventListener('click', ()=>{
		popup.showModal();
	});

	cartClose.addEventListener('click', ()=>{
		popup.close();
	});
	cartClose.addEventListener('keydown', (e)=>{
		if(e.key==='Escape')
			popup.close();
	});
}
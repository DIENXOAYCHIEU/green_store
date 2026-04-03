function popup(modalId, btnId, closeId, isDialog){
	let btn = document.getElementById(btnId);
	let modal = document.getElementById(modalId);
	if(btn && modal){
		btn.addEventListener('click',()=>{
			let isChanged = modal.dataset.toggle==='true';
			if(isChanged){
				modal.dataset.toggle='false';
				modal.close();
			}
			else{
				modal.dataset.toggle='true';
				if(isDialog){
					modal.showModal();
				}
				else
					modal.show();
			}
		});
		modal.addEventListener('keydown', (e)=>{
			if(e.key==='Escape'){
				modal.dataset.toggle='false';
				modal.close();
			}
		});
		if(closeId){
			document.getElementById(closeId).
			addEventListener('click',()=>{
				modal.dataset.toggle='false';
				modal.close();				
			});
		}
	}
}

popup('menu-modal','menu-button');
popup('search-modal','search-button', 'search-close', true);
popup('cart-popup','cart-button', 'cart-close');
popup('account-modal','account-button');
let btnFilterPrice = document.getElementById('filter-price');
let dialogFilterPrice = document.getElementById('dialog-filter-price');
if (btnFilterPrice && dialogFilterPrice){
	btnFilterPrice.addEventListener('click',()=>{
		dialogFilterPrice.show();
	});
}

function paginateBtn(inputId){
	let tag=document.getElementById(inputId);
	if(!tag) return;

	let lastPage = Number(tag.dataset.last);
	tag.type='number';
	tag.min=1;
	tag.max=lastPage;
	tag.addEventListener('input', (e)=>{
		let page = Number(e.target.value);
		if(Number.isInteger(page) && page>=1 && page<=lastPage){
			const currentURL = new URL(window.location.href);
			const params = currentURL.searchParams;
			params.set('page',page);
			currentURL.search= params.toString();
			window.location.href= currentURL.toString();
			tag.dataset.current=page;
		}
	});
	tag.value=Number(tag.dataset.current);
}
paginateBtn('page-of-products');
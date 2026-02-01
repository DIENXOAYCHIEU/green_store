let sortOption = document.getElementById('sort-options');
if (sortOption){
	sortOption.addEventListener('change', function(){
		const currentURL = new URL(window.location.href);
		const params = currentURL.searchParams;
		params.set('selected_sort_option_id', sortOption.value);
		currentURL.search= params.toString();
		window.location.href= currentURL.toString();
	});
}
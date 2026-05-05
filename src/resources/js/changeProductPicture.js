document.querySelectorAll('.detail-image').forEach(img=>{
	img.addEventListener('click',()=>{
		document.getElementById('product-picture').src=img.src;
	})
});

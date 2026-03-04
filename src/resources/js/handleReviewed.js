const usersReview = document.getElementById('users-review');
if(usersReview){
	usersReview.addEventListener('input', ()=>{
		usersReview.style.height= 'auto';
		usersReview.style.height= usersReview.scrollHeight + 'px';
	});
}

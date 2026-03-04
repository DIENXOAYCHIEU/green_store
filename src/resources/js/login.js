// show and hide password
function togglePassword(inputId, toggleBtn){
	let content = document.getElementById(inputId);
	let btn = document.getElementById(toggleBtn);
	if(!content || !btn) return;

	btn.addEventListener('click', ()=>{
		let changed = content.dataset.toggle==='true';

		if(changed){
			content.type='password';
			content.dataset.toggle='false';
		}
		else{
			content.type='text';
			content.dataset.toggle='true';
		}
	})
}

togglePassword('password', 'toggle-password');
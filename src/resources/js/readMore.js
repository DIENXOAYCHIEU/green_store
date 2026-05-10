
// read more text comment of reviews
function readMoreText(limit = 200){
	let containers = document.querySelectorAll('.text-container');
	if (!containers)
		return;

	containers.forEach((container)=>{
		let text = container.dataset.text;
		if(text.length>limit){
			let shortText= text.slice(0,limit) + '...';
			let textSpan = document.createElement('span');
			textSpan.textContent=shortText;

			let toggleBtn = document.createElement('span');
			toggleBtn.textContent='Đọc thêm';
			toggleBtn.classList.add(
				'text-gray-500',
				'underline',
				'cursor-pointer',
				'toggle'
			);
			toggleBtn.dataset.toggle='true';
			container.appendChild(textSpan);
			container.appendChild(toggleBtn);

			toggleBtn.addEventListener('click', ()=>{
				let expanded= toggleBtn.dataset.toggle==='true';

				if(expanded){
					textSpan.textContent=text;
					toggleBtn.textContent='Ẩn bớt';
					toggleBtn.dataset.toggle='false';
				}
				else{
					textSpan.textContent=shortText;
					toggleBtn.textContent='Đọc thêm';
					toggleBtn.dataset.toggle='true';					
				}
			});
		}
		else{
			container.innerHTML=`
				${text}
			`;				
		}
	});
}
readMoreText();
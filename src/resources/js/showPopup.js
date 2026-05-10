/**
 * Show a popup notification
 * @param {string} message - The message to display
 * @param {string} type - 'success' or 'error'
 * @param {number} duration - Duration in ms (default 3000)
 */
function showPopup(message, type = 'success', duration = 3000) {
	// Remove existing popup if any
	const existingPopup = document.getElementById('popup-notification');
	if (existingPopup) {
		existingPopup.remove();
	}

	// Create popup container
	const popup = document.createElement('div');
	popup.id = 'popup-notification';
	popup.className = `fixed top-20 left-1/2 -translate-x-1/2 z-50 px-6 py-4 rounded-lg shadow-lg text-white font-bold text-center max-w-md
		${type === 'success' ? 'bg-green-500' : 'bg-red-500'}
		animate-slide-down`;

	popup.textContent = message;

	document.body.appendChild(popup);

	// Auto-remove after duration
	setTimeout(() => {
		popup.classList.add('animate-slide-up');
		setTimeout(() => {
			popup.remove();
		}, 300);
	}, duration);
}

export { showPopup };

const logOutModal = new bootstrap.Modal(document.getElementById('LogOutAlertModal'))
const logoutBtn = document.getElementById('logoutBtn');
logoutBtn.addEventListener('click', () => {
    logOutModal.show();
})
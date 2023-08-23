document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("userFormDelete");
    const deleteAccountBtn = document.getElementById("deleteAccountBtn");
    const userPassDelete = document.getElementById("userPassDelete");
    const userPassConfirm = document.getElementById("userPassConfirm");
    const myModal = new bootstrap.Modal(document.getElementById('notMatchPassAlert'));
    deleteAccountBtn.addEventListener("click", function(event) {
        event.preventDefault();
        // Get the values of the password fields
        const passwordDelete = userPassDelete.value;
        const passwordConfirm = userPassConfirm.value;
        // Perform the validation
        if (passwordDelete !== passwordConfirm) {
            myModal.show();
            return;
        }

        // If validation passes, proceed with the form submission (delete account)
        form.submit();
    });
});

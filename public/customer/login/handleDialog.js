document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('signup-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        // Get data from the form
        const fullName = document.getElementById('userfirstname').value.trim();
        const email = document.getElementById('userEmail').value.trim();
        // Send form data to the server using Fetch API or AJAX
        fetch(form.action, {
                method: 'POST',
                body: new FormData(form)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success dialog
                    Swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'Sign In',
                        showCancelButton: true,
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If the user clicks OK, redirect to the login page
                            window.location.href = 'login-customer';
                        } else if (result.dismiss === Swal.DismissReason.cancel) {}
                    });
                } else {
                    // Show error dialog
                    Swal.fire({
                        title: 'Error!',
                        text: data.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while processing your request. Please try again later.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
    });
});
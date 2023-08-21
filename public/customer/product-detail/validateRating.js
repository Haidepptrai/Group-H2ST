// Form submission and validation
document
    .getElementById("feedback-form")
    .addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Perform client-side validation
        var rating = document.querySelector('input[name="rating"]:checked');

        if (!rating) {
            // Show the validation error modal
            var ratingModal = new bootstrap.Modal(
                document.getElementById("ratingModal")
            );
            ratingModal.show();
        } else {
            // Submit the form
            this.submit();
        }
    });

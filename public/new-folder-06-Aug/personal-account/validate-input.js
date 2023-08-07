const form = document.getElementById("userForm");
const ratingModal = new bootstrap.Modal(document.getElementById("nameAlert"));

// Add event listener for form submission
form.addEventListener("submit", function (event) {
    // Prevent the form from submitting
    event.preventDefault();

    // Get the values of first name and last name input fields
    const firstName = document.getElementById("firstName").value;
    const lastName = document.getElementById("lastName").value;

    // Define regular expression to check for numbers and special characters
    const regex = /^[a-zA-Z\u00C0-\u024F\u1E00-\u1EFF\s]+$/;

    // Validate first name and last name
    if (
        (firstName.trim() === "" && lastName.trim() === "") ||
        !firstName.match(regex) ||
        !lastName.match(regex)
    ) {
        ratingModal.show();
        return;
    }

    // If the validation passes, submit the form
    form.submit();
});

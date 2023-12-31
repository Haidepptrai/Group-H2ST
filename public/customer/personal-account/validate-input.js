const form = document.getElementById("userForm");
const ratingModal = new bootstrap.Modal(document.getElementById("nameAlert"));

// Add event listener for form submission
form.addEventListener("submit", function (event) {
    // Prevent the form from submitting
    event.preventDefault();

    // Get the values of first name and last name input fields
    const firstName = document.getElementById("userfirstName").value;
    const lastName = document.getElementById("userlastName").value;
    // Define regular expression to check for numbers and special characters
    const pattern = /^[a-zA-ZÀ-ÿ\s]+$/;
    // Validate first name and last name
    if ((firstName.trim() === "") || (lastName.trim() === "") || (!pattern.test(firstName))) {
        ratingModal.show();
        return;
    }

    // If the validation passes, submit the form
    form.submit();
});

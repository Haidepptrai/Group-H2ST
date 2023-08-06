// Get the feedback form and rating modal elements
const feedbackForm = document.getElementById("feedback-form");
const ratingModal = new bootstrap.Modal(document.getElementById("ratingModal"));

// Add event listener for form submission
feedbackForm.addEventListener("submit", function (event) {
  event.preventDefault();

  // Get the selected rating
  const selectedRating = document.querySelector('input[name="rating"]:checked');

  if (!selectedRating) {
    // Show the Bootstrap modal if no rating is selected
    ratingModal.show();
    return;
  }

  // Get the value of the selected rating
  const ratingValue = selectedRating.value;

  // Get the name and thought inputs
  const nameInput = document.getElementById("exampleFormControlInput1").value;
  const thoughtInput = document.getElementById(
    "exampleFormControlTextarea1"
  ).value;

  // Do something with the rating, name, and thought (e.g., send to server using Ajax)
  console.log("Rating:", ratingValue);
  console.log("Name:", nameInput);
  console.log("Thought:", thoughtInput);

  // Reset the form after submission
  feedbackForm.reset();
});

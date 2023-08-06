// Get the password input element by its ID
const userPass = document.getElementById("userPass");

// Get the "Save changes" button by its ID
const saveChangesBtn = document.getElementById("saveChangesBtn");

// Function to check if the password field is filled
function checkPassword() {
  const passwordValue = userPass.value;

  // Enable the "Save changes" button if the password field is not empty
  if (passwordValue.trim() !== "") {
    saveChangesBtn.removeAttribute("disabled");
  } else {
    saveChangesBtn.setAttribute("disabled", "true");
  }
}

// Add event listener for changes in the password field
userPass.addEventListener("input", checkPassword);

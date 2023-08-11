const previous = document.getElementById("previous");
const next = document.getElementById("next");
const quantity = document.getElementById("quantity");
quantity.placeholder = 1;
let integerValue = parseInt(quantity.placeholder, 10);
const min = 1;
const max = 30;
previous.classList.add("disable");


previous.addEventListener("click", function () {
  next.classList.remove("disable");
  if (integerValue > min) {
    integerValue -= 1;
    quantity.placeholder = integerValue;
  }

  if (integerValue == min) {
    previous.classList.add("disable");
  }
});

next.addEventListener("click", function () {
  previous.classList.remove("disable");
  if (integerValue < max) {
    integerValue += 1;
    quantity.placeholder = integerValue;
  }
  if (integerValue == max) {
    next.classList.add("disable");
  }
});

const previous = document.getElementById("previous");
const next = document.getElementById("next");
const quantity = document.getElementById("quantity");
quantity.textContent = 1;
let integerValue = parseInt(quantity.textContent, 10);
const min = 1;
const max = 20;
previous.addEventListener("click", function () {
  next.classList.remove("disable");
  if (integerValue > min) {
    integerValue -= 1;
    quantity.textContent = integerValue;
  }

  if (integerValue == min) {
    previous.classList.add("disable");
  }
});

next.addEventListener("click", function () {
  previous.classList.remove("disable");
  if (integerValue < max) {
    integerValue += 1;
    quantity.textContent = integerValue;
  }
  if (integerValue == max) {
    next.classList.add("disable");
  }
});
